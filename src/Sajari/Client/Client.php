<?php

namespace Sajari\Client;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use Sajari\Document\Document;
use Sajari\Document\Key;
use Sajari\Document\KeyMeta;
use Sajari\Search\Request;
use Sajari\Document\Meta;
use Sajari\Search\Result;
use Sajari\Search\Response;

use sajari\engine\store\doc\Documents;
use sajari\engine\store\doc\Documents\Document\MetaEntry;
use sajari\engine\store\doc\DocumentClient;
use Sajari\engine\store\doc\Keys;
use Sajari\engine\store\doc\Keys\Key as ProtoKey;
use sajari\engine\store\doc\KeysMetas;
use sajari\engine\store\doc\KeysMetas\KeyMeta as ProtoKeyMeta;
use sajari\engine\query\QueryClient;

class Client
{
    private $projectID = '';
    private $collection = '';
    private $endpoint = 'api.sajari.com:1234';
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
    public function Get(Key $key)
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

            /** @var $m engine\store\doc\Documents\Document\MetaEntry */
            foreach ($doc->getMetaList() as $m) {
                $meta[] = new Meta($m->getKey(), json_decode($m->getValue()));
            }

            $docs[] = new Document($meta);
        }

        return $docs;
    }

    private function protoKeysFromKeys(array $keys)
    {
        $protoKeys = new Keys();

        /** @var $k Key */
        foreach ($keys as $k) {
            $protoKey = new ProtoKey();
            $protoKey->setField($k->getField());
            $protoKey->setValue($k->getValue());

            $protoKeys->addKeys($protoKey);
        }

        return $protoKeys;
    }

    private function getDocumentClient()
    {
        if ($this->documentClient != null) {
            return $this->documentClient;
        }

        $this->documentClient = new DocumentClient($this->endpoint, [
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
        return $this->AddMulti(array($doc))[0];
    }

    /**
     * @param Document[] $docs
     * @return Key[]
     * @throws Exception
     */
    public function AddMulti(array $docs)
    {
//        $protoDocs = new \sajari\engine\store\doc\Documents();
        $protoDocs = new Documents();

        /** @var $d Document */
        foreach ($docs as $d) {
            $protoDoc = new \sajari\engine\store\doc\Documents\Document();
            foreach ($d->getMeta() as $m) {
                $meta = new MetaEntry();
                $meta->setKey($m->getKey());
                $meta->setValue(json_encode($m->getValue()));

                $protoDoc->addMeta($meta);
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

        /** @var $k engine\store\doc\Keys\Key */
        foreach ($reply->getKeysList() as $k) {
            $keys[] = new Key($k->getField(), json_decode($k->getValue()));
        }

        return $keys;
    }

    /**
     * @param Key $key
     * @throws Exception
     */
    public function Delete(Key $key)
    {
        $this->DeleteMulti(array($key));
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
    }

    public function Patch(KeyMeta $km)
    {
        $this->PatchMulti(array($km));
    }

    /**
     * @param KeyMeta[] $kms
     * @throws Exception
     */
    public function PatchMulti(array $kms)
    {
        $protoKeyMetas = new KeysMetas();

        /** @var $km KeyMeta */
        foreach ($kms as $km) {
            $protoKeyMeta = new ProtoKeyMeta();
            $protoKeyMeta->setKey($km->getKey()->Proto());

            foreach ($km->getMeta() as $m) {
                $protoKeyMeta->addMeta($m->Proto());
            }

            $protoKeyMetas->addKeysMetas($protoKeyMeta);
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
    }

    /**
     * @param Request $r
     * @return Response
     * @throws Exception
     */
    public function Search(Request $r)
    {
        // Make Request
        /** @var engine\query\Response $reply */
        list($reply, $status) = $this->getSearchClient()->Search(
            $r->Proto(),
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

        // Reads
        /** @var integer $reads */
        $reads = $reply->getReads();

        // Time
        /** @var string $time */
        $time = $reply->getTime();

        // Total Results
        /** @var integer $total */
        $total = $reply->getTotalResults();

        // Results
        $results = array();

        /** @var engine\query\Result[] $protoResponseList */
        $protoResponseList = $reply->getResultsList();

        foreach ($protoResponseList as $protoResult) {
            $meta = array();

            /** @var engine\query\Result\MetaEntry $protoMeta */
            foreach ($protoResult->getMetaList() as $protoMeta) {
                $meta[] = new Meta($protoMeta->getKey(), $protoMeta->getValue());
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
        $protoAggregateList = $reply->getAggregatesList();

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
                    var_dump($b);
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

        return new Response($total, $reads, $time, $results, $aggregateList);
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
