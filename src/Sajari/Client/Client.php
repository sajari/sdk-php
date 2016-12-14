<?php

namespace Sajari\Client;

// require_once __DIR__.'/../proto/doc.php';
// require_once __DIR__.'/../proto/query.php';
// require_once __DIR__.'/../proto/key.php';
// require_once __DIR__.'/../proto/status.php';
// require_once __DIR__.'/../proto/api-query.php';

require_once __DIR__.'/../proto/engine/value.php';
require_once __DIR__.'/../proto/api/query/v1/query.php';

use Sajari\Record\Record;
use Sajari\Record\Key as RecordKey;
use Sajari\Record\KeyValue;
use Sajari\Search\Request;
use Sajari\Record\Value;
use Sajari\Search\Result;
use Sajari\Search\Response;
use Sajari\Search\Tracking;
use Sajari\Search\ClickToken;
use Sajari\Search\PosNegToken;
use Sajari\Client\Opt;

// use sajari\engine\store\doc\Documents;
// use sajari\engine\store\doc\Documents\Document\MetaEntry;
// use sajari\engine\store\doc\StoreClient;
use Sajari\engine\store\record\Keys;
use sajari\engine\Value as EngineValue;
use sajari\engine\Key as EngineKey;
// use sajari\engine\store\doc\Document\ValuesEntry;
// use sajari\engine\store\doc\KeysValues;
// use sajari\engine\store\doc\KeysValues\KeyValues;

use sajari\api\query\v1\QueryClient;
use sajari\api\query\SearchRequest as ProtoSearchRequest;

use Grpc\ChannelCredentials;

class Client
{
    private $projectID = '';
    private $collection = '';
    private $endpoint = 'api.sajari.com:443';
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
        $this->credentials = ChannelCredentials::createSsl(file_get_contents(dirname(__FILE__) . "/roots.pem"));

        /** @var $opt Opt */
        foreach ($dialOptions as $opt) {
            $opt->Apply($this);
        }

        $this->searchClient = new QueryClient($this->endpoint, [
            'credentials' => $this->credentials,
        ]);
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

    public function getCallMeta()
    {
        return array(
            'project' => array($this->projectID),
            'collection' => array($this->collection),
            'authorization' => array($this->auth),
        );
    }

    /**
     * @return Value
     */
    public function getValue($m)
    {
      $v = $m->getValue();
      if ($v->hasSingle()) {
        return new Value($m->getKey(), $v->getSingle());
      } else if ($v->hasRepeated()) {
        return new Value($m->getKey(), $v->getRepeated()->getValuesList());
      } else {
        return new Value($m->getKey(), NULL);
      }
    }

    /**
     * @param RecordKey $key
     * @return Record
     * @throws Exception
     */
    public function Get(RecordKey $key)
    {
        return $this->GetMulti(array($key))[0];
    }

    /**
     * @param RecordKey[] $keys
     * @return Record[]
     * @throws Exception
     */
    public function GetMulti(array $keys)
    {
        $protoKeys = $this->protoKeysFromKeys($keys);

        list($reply, $status) = $this->getDocumentClient()->Get(
            $protoKeys,
            $this->getCallMeta()
        )->wait();

        if ($status->code !== 0) {
            throw new \Exception($status->details);
        }

        $docs = array();

        foreach ($reply->getDocumentsList() as $doc) {
            $value = array();

            foreach ($doc->getValuesList() as $m) {
                $value[] = $this->getValue();
                $v = $m->getValue();
                if ($v->hasSingle()) {
                  $value[] = new Value($m->getKey(), $v->getSingle());
                } else if ($v->hasRepeated()) {
                  $value[] = new Value($m->getKey(), $v->getRepeated()->getValuesList());
                } else {
                  $value[] = new Value($m->getKey(), NULL);
                }
            }

            $docs[] = new Record($value);
        }

        return $docs;
    }

    /**
     * @param RecordKey[]
     * @return Keys
     */
    private function protoKeysFromKeys(array $keys)
    {
        $protoKeys = new Keys();

        /** @var RecordKey $k */
        foreach ($keys as $k) {
            $protoKeys->addKeys($k->Proto());
        }

        return $protoKeys;
    }

    /**
     * @return StoreClient
     */
    private function getDocumentClient()
    {
        if ($this->documentClient !== null) {
            return $this->documentClient;
        }

        $this->documentClient = new StoreClient($this->endpoint, [
            'credentials' => $this->credentials,
        ]);

        return $this->documentClient;
    }

    /**
     * @param Record $rec
     * @return Key
     * @throws Exception
     */
    public function Add(Record $rec)
    {
        $multiResult = $this->AddMulti([$rec]);

        // Return the first key and status from add multi
        return [$multiResult[0][0], $multiResult[1][0]];
    }

    /**
     * @param Record[] $docs
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
                $v = new EngineValue();
                $v->setSingle($m->getValue());
                $valueEntry->setValue($v);

                $protoDoc->addValues($valueEntry);
            }

            $protoDocs->addDocuments($protoDoc);
        }

        /** @var $reply Keys */
        list($reply, $status) = $this->getDocumentClient()->Add(
            $protoDocs,
            $this->getCallMeta()
        )->wait();

        if ($status->code !== 0) {
            throw new \Exception($status->details);
        }

        $keys = array();

        /** @var $k EngineKey */
        foreach ($reply->getKeysList() as $k) {
            $value = $k->getValue();
            if (is_null($value)) {
              $keys[] = new RecordKey(NULL, NULL);
              continue;
            }
            $extractedValue = NULL;
            if ($value->hasSingle()) {
              $extractedValue = $value->getSingle();
            } else if ($value->hasRepeated()) {
              $extractedValue = $value->getRepeated()->getValuesList();
            }

            $keys[] = new RecordKey($k->getField(), $extractedValue);
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
            $this->getCallMeta()
        )->wait();

        if ($status->code !== 0) {
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
     * @param KeyValue[] $kvs
     * @throws Exception
     */
    public function PatchMulti(array $kvs)
    {
        $protoKeyValues = new KeysValues();

        /** @var $kv KeyValue */
        foreach ($kvs as $kv) {
            $protoKeyValue = new KeyValues();

            $k = new EngineKey();
            $k->setField($kv->getKey()->getField());

            $v = new EngineValue();

            $v->setSingle($kv->getKey()->getValue());
            $k->setValue($v);

            $protoKeyValue->setKey($k);

            foreach ($kv->getMeta() as $m) {
                $protoKeyValue->addValues($m->Proto());
            }

            $protoKeyValues->addKeysValues($protoKeyValue);
        }

        list($reply, $status) = $this->getDocumentClient()->Patch(
            $protoKeyValues,
            $this->getCallMeta()
        )->wait();

        if ($status->code !== 0) {
            throw new \Exception($status->details);
        }

        return $reply->getStatusList();
    }

    /**
     * @param Request $r
     * @param Tracking $t
     * @return Response
     * @throws Exception
     */
    public function Search(Request $r, Tracking $t = NULL)
    {
        if (is_null($t)) {
          $t = new Tracking();
        }

        $searchRequest = $r->Proto();
        // Make Request
        /** @var engine\query\Response $reply */
        list($reply, $status) = $this->searchClient->Search(
            $searchRequest,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        if ($status->code !== 0) {
            throw new \Exception($status->details, $status->code);
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
                  $meta[] = new Value($protoMeta->getKey(), $v->getSingle());
                } else if ($v->hasRepeated()) {
                  $meta[] = new Value($protoMeta->getKey(), $v->getRepeated()->getValuesList());
                } else {
                  $meta[] = new Value($protoMeta->getKey(), NULL);
                }
            }

            $result = new Result(
                $protoResult->getScore(),
                $protoResult->getIndexScore(),
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
}
