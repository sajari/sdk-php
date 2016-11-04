<?php

namespace Sajari\Client;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/value.php';
require_once __DIR__.'/../proto/query.php';
require_once __DIR__.'/../proto/key.php';
require_once __DIR__.'/../proto/status.php';
require_once __DIR__.'/../proto/api-query.php';

use Sajari\Document\Document;
use Sajari\Document\Key as DocumentKey;
use Sajari\Document\KeyMeta;
use Sajari\Search\Request;
use Sajari\Document\Meta;
use Sajari\Search\Result;
use Sajari\Search\Response;
use Sajari\Search\Tracking;
use Sajari\Search\ClickToken;
use Sajari\Search\PosNegToken;

use sajari\engine\store\doc\Documents;
use sajari\engine\store\doc\Documents\Document\MetaEntry;
use sajari\engine\store\doc\StoreClient;
use Sajari\engine\store\doc\Keys;
use sajari\api\query\QueryClient;
// use sajari\engine\Key as PKey;
use sajari\engine\Value as Value;
use sajari\engine\store\doc\Document\ValuesEntry;
use sajari\engine\store\doc\KeysValues;
use sajari\engine\store\doc\KeysValues\KeyValues;
use sajari\api\query\SearchRequest as ProtoSearchRequest;

class Client
{
    private $projectID = '';
    private $collection = '';
    private $endpoint = 'api.sajari.com:433';
    private $auth = '';
    private $credentials;
    private $documentClient;
    private $searchClient;
    private $grpcDialOptions;

    /**
     * Client constructor.
     * @param string $projectID
     * @param string $collection
     * @param Opt[] $dialOptions
     */
    public function __construct($projectID, $collection, $dialOptions)
    {
        $this->projectID = $projectID;
        $this->collection = $collection;
        $this->credentials = \Grpc\ChannelCredentials::createSsl(file_get_contents(dirname(__FILE__) . "/roots.pem")); // createDefault(); //createInsecure();

        /** @var $opt Opt */
        foreach ($dialOptions as $opt) {
            $opt->Apply($this);
        }
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * @param string $auth
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }

    /**
     * @return mixed
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @param mixed $credentials
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param Key $key
     * @return Document
     * @throws Exception
     */
    public function Get(DocumentKey $key)
    {
        return $this->GetMulti(array($key))[0];
    }

    /**
     * @param Key[] $keys
     * @return Document[]
     * @throws Exception
     */
    public function GetMulti(array $keys)
    {
        $protoKeys = $this->protoKeysFromKeys($keys);

        list($reply, $status) = $this->getDocumentClient()->Get(
            $protoKeys,
            array(
                'project' => array($this->projectID),
                'collection' => array($this->collection),
                'authorization' => array($this->auth),
            )
        )->wait();

        if ($status->code != 0) {
            throw new \Exception($status->details);
        }

        $docs = array();

        foreach ($reply->getDocumentsList() as $doc) {
            $meta = array();

            foreach ($doc->getValuesList() as $m) {
                $v = $m->getValue();
                if ($v->hasSingle()) {
                  $meta[] = new Meta($m->getKey(), $v->getSingle());
                } else if ($v->hasRepeated()) {
                  $meta[] = new Meta($m->getKey(), $v->getRepeated()->getValuesList());
                } else {
                  $meta[] = new Meta($m->getKey(), NULL);
                }
            }

            $docs[] = new Document($meta);
        }

        return $docs;
    }

    private function protoKeysFromKeys(array $keys)
    {
        $protoKeys = new Keys();

        foreach ($keys as $k) {
            $protoKeys->addKeys($k->Proto());
        }

        return $protoKeys;
    }

    private function getDocumentClient()
    {
        if ($this->documentClient != null) {
            return $this->documentClient;
        }

        $this->documentClient = new StoreClient($this->endpoint, [
            'credentials' => $this->credentials,
        ]);

        return $this->documentClient;
    }

    /**
     * @param Document $doc
     * @return Key
     * @throws Exception
     */
    public function Add(Document $doc)
    {
        $multiResult = $this->AddMulti([$doc]);

        // Return the first key and status from add multi
        return [$multiResult[0][0], $multiResult[1][0]];
    }

    /**
     * @param Document[] $docs
     * @return Key[]
     * @throws Exception
     */
    public function AddMulti(array $docs)
    {
        $protoDocs = new Documents();

        /** @var $d Document */
        foreach ($docs as $d) {
            $protoDoc = new \sajari\engine\store\doc\Document();
            foreach ($d->getMeta() as $m) {
                $valueEntry = new ValuesEntry();
                $valueEntry->setKey($m->getKey());
                $v = new Value();
                $v->setSingle($m->getValue());
                $valueEntry->setValue($v);

                $protoDoc->addValues($valueEntry);
            }

            $protoDocs->addDocuments($protoDoc);
        }

        /** @var $reply \sajari\engine\store\doc\Keys */
        list($reply, $status) = $this->getDocumentClient()->Add(
            $protoDocs,
            array(
                'project' => array($this->projectID),
                'collection' => array($this->collection),
                'authorization' => array($this->auth),
            )
        )->wait();

        if ($status->code != 0) {
            throw new \Exception($status->details);
        }

        $keys = array();

        /** @var $k \sajari\engine\Key */
        foreach ($reply->getKeysList() as $k) {
            $value = $k->getValue();
            if (is_null($value)) {
              $keys[] = new DocumentKey(NULL, NULL);
              continue;
            }
            $extractedValue = NULL;
            if ($value->hasSingle()) {
              $extractedValue = $value->getSingle();
            } else if ($value->hasRepeated()) {
              $extractedValue = $value->getRepeated()->getValuesList();
            }

            $keys[] = new DocumentKey($k->getField(), $extractedValue);
        }

        return [$keys, $reply->getStatusList()];
    }

    /**
     * @param Key $key
     * @throws Exception
     */
    public function Delete($key)
    {
        $multiResult = $this->DeleteMulti([$key]);
        if ($multiResult == NULL) {
          return NULL;
        } else {
          return $multiResult[0];
        }
    }

    /**
     * @param Key[] $keys
     * @throws Exception
     */
    public function DeleteMulti(array $keys)
    {
        $protoKeys = $this->protoKeysFromKeys($keys);

        list($reply, $status) = $this->getDocumentClient()->Delete(
            $protoKeys,
            array(
                'project' => array($this->projectID),
                'collection' => array($this->collection),
                'authorization' => array($this->auth),
            )
        )->wait();

        if ($status->code != 0) {
            throw new \Exception($status->details);
        }

        return $reply->getStatusList();
    }

    public function Patch($km)
    {
      $multiResult = $this->PatchMulti(array($km));
      if ($multiResult == NULL) {
        return NULL;
      } else {
        return $multiResult[0];
      }
    }

    /**
     * @param KeyMeta[] $kms
     * @throws Exception
     */
    public function PatchMulti(array $kms)
    {
        $protoKeyMetas = new KeysValues();

        /** @var $km KeyMeta */
        foreach ($kms as $km) {
            $protoKeyMeta = new KeyValues();

            $k = new \sajari\engine\Key();
            $k->setField($km->getKey()->getField());

            $v = new \sajari\engine\Value();

            $v->setSingle($km->getKey()->getValue());
            $k->setValue($v);

            $protoKeyMeta->setKey($k);

            foreach ($km->getMeta() as $m) {
                $protoKeyMeta->addValues($m->Proto());
            }

            $protoKeyMetas->addKeysValues($protoKeyMeta);
        }

        list($reply, $status) = $this->getDocumentClient()->Patch(
            $protoKeyMetas,
            array(
                'project' => array($this->projectID),
                'collection' => array($this->collection),
                'authorization' => array($this->auth),
            )
        )->wait();

        if ($status->code != 0) {
            throw new \Exception($status->details);
        }

        return $reply->getStatusList();
    }

    public function Compare(CompareRequest $r)
    {
      list($reply, $status) = $this->getSearchClient()->Compare(
        $r->Proto(),
        array(
            'project' => array($this->projectID),
            'collection' => array($this->collection),
            'authorization' => array($this->auth),
        )
      )->wait();

      // Check for server error
      if ($status->code != 0) {
          throw new \Exception('Error code not zero');
      }

      var_dump($reply);
    }

    /**
     * @param Request $r
     * @return Response
     * @throws Exception
     */
    public function Search(Request $r, Tracking $t = NULL)
    {
        if (is_null($t)) {
          $t = new Tracking();
        }

        $searchRequest = new ProtoSearchRequest();

        $searchRequest->setTracking($t->Proto());
        $searchRequest->setSearchRequest($r->Proto());

        // Make Request
        /** @var engine\query\Response $reply */
        list($reply, $status) = $this->getSearchClient()->Search(
            $searchRequest,
            array(
                'project' => array($this->projectID),
                'collection' => array($this->collection),
                'authorization' => array($this->auth),
            )
        )->wait();

        // Check for server error
        if ($status->code != 0) {
            throw new \Exception($status->details);
        }

        // Transform proto to user-friendly objects

        $response = $reply->getSearchResponse();

        // Reads
        /** @var integer $reads */
        $reads = $response->getReads();

        // Time
        /** @var string $time */
        $time = $response->getTime();

        // Total Results
        /** @var integer $total */
        $total = $response->getTotalResults();

        // Results
        $results = array();

        /** @var engine\query\Result[] $protoResponseList */
        $protoResponseList = $response->getResultsList();

        foreach ($protoResponseList as $protoResult) {
            $meta = array();
            /** @var engine\query\Result\MetaEntry $protoMeta */
            foreach ($protoResult->getValuesList() as $protoMeta) {
                /** @var sajari\engine\Value $v */
                $v = $protoMeta->getValue();
                if ($v->hasSingle()) {
                  $meta[] = new Meta($protoMeta->getKey(), $v->getSingle());
                } else if ($v->hasRepeated()) {
                  $meta[] = new Meta($protoMeta->getKey(), $v->getRepeated()->getValuesList());
                } else {
                  $meta[] = new Meta($protoMeta->getKey(), NULL);
                }
            }

            $result = new Result(
                $protoResult->getScore(),
                $protoResult->getRawScore(),
                $meta
            );

            $results[] = $result;
        }

        // Aggregates
        /** @var engine\query\Response\AggregatesEntry[] $protoAggregateList */
        $protoAggregateList = $response->getAggregatesList();

        $aggregateList = array();
        foreach ($protoAggregateList as $a) {
            /** @var engine\query\AggregateResponse $ar */
            $ar = $a->getValue();

            if ($ar->hasBuckets()) {
                /** @var engine\query\AggregateResponse\Buckets $b */
                $buckets = $ar->getBuckets();

                $bucketArray = array();

                /** @var engine\query\AggregateResponse\Buckets\BucketsEntry $be */
                foreach ($buckets->getBucketsList() as $be) {
                    /** @var engine\query\AggregateResponse\Buckets\Bucket $b */
                    $b = $be->getValue();
                    $bucketArray[$b->getName()] = new BucketResponseAggregate($b->getName(), $b->getCount());
                }

                $aggregateList[$a->getKey()] = $bucketArray;
            } elseif ($ar->hasCount()) {
                /** @var engine\query\AggregateResponse\Count $counts */
                $counts = $ar->getCount();

                $countArray = array();

                /** @var engine\query\AggregateResponse\Count\CountsEntry $ce */
                foreach ($counts->getCountsList() as $ce) {
                    $countArray[$ce->getKey()] = new CountResponseAggregate($ce->getKey(), $ce->getValue());
                }

                $aggregateList[$a->getKey()] = $countArray;
            } elseif ($ar->hasMetric()) {
                /** @var engine\query\AggregateResponse\Metric */
                $m = $ar->getMetric();

                $aggregateList[$a->getKey()] = new MetricResponseAggregate($m->getValue());
            }
        }

        $tokens = [];
        if ($reply->hasTokens()) {
          foreach ($reply->getTokensList() as $protoToken) {
            $token = NULL;
            if ($protoToken->hasClick()) {
              $token = new ClickToken($protoToken->getClick()->getClick());
            } else {
              $token = new PosNegToken(
                $protoToken->getPosNeg()->getPos(),
                $protoToken->getPosNeg()->getNeg()
              );
            }
            $tokens[] = $token;
          }
        }

        return new Response($total, $reads, $time, $results, $aggregateList, $tokens);
    }

    /**
     * @return engine\query\QueryClient
     */
    private function getSearchClient()
    {
        if ($this->searchClient != null) {
            return $this->searchClient;
        }

        $this->searchClient = new QueryClient($this->endpoint, [
            'credentials' => $this->credentials,
        ]);

        return $this->searchClient;
    }
}
