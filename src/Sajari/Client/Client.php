<?php
/**
 * Class Client | Sajari/Client/Client.php
 *
 * @package     sajari-sdk-php
 */

namespace Sajari\Client;

require_once __DIR__.'/../proto/engine/value.php';
require_once __DIR__.'/../proto/engine/key.php';
require_once __DIR__.'/../proto/engine/status.php';
require_once __DIR__.'/../proto/engine/store/record/record.php';
require_once __DIR__.'/../proto/api/query/v1/query.php';


/**
 * Class Client
 */
class Client
{
    /** @var string $projectID */
    private $projectID = '';
    /** @var string $collection */
    private $collection = '';
    /** @var string $endpoint */
    private $endpoint = 'api.sajari.com:443';
    /** @var \sajari\engine\store\record\StoreClient $storeClient */
    private $storeClient;
    /** @var \sajari\api\query\v1\QueryClient $searchClient */
    private $searchClient;

    /**
     * Client constructor
     * @param \sajari\api\query\v1\QueryClient $queryClient
     * @param \sajari\engine\store\record\StoreClient $storeClient
     * @param string $projectID
     * @param string $collection
     * @param \Sajari\Client\Opt[] $dialOptions
     */
    public function __construct(\sajari\api\query\v1\QueryClient $queryClient, \sajari\engine\store\record\StoreClient $storeClient, $projectID, $collection, $dialOptions)
    {
        $this->projectID = $projectID;
        $this->collection = $collection;

        /** @var $opt Opt */
        foreach ($dialOptions as $opt) {
            $opt->Apply($this);
        }

        $this->searchClient = $queryClient;
        $this->storeClient = $storeClient;
    }

    /**
     * Creates a new Client with defaults set
     * @param string $projectID
     * @param string $collection
     * @param \Sajari\Client\Opt[] $dialOptions
     * @return Client
     */
    public static function NewClient($projectID, $collection, array $dialOptions)
    {
        $credentials = \Grpc\ChannelCredentials::createSsl(file_get_contents(dirname(__FILE__) . "/roots.pem"));

        return new Client(
            new \sajari\api\query\v1\QueryClient('api.sajari.com:443', [
                'credentials' => $credentials,
            ]),
            new \sajari\engine\store\record\StoreClient('api.sajari.com:443', [
                'credentials' => $credentials,
            ]),
            $projectID,
            $collection,
            $dialOptions
        );
    }

    /**
     * @return array
     */
    private function getCallMeta()
    {
        return array(
            'project' => array($this->projectID),
            'collection' => array($this->collection),
            'authorization' => array($this->auth),
        );
    }

    /**
     * @param \Sajari\Record\Key $key
     * @return array
     * @throws \Sajari\Error\RecordNotFoundException
     */
    public function Get(\Sajari\Record\Key $key)
    {
        try {
            list($res, $status) = $this->GetMulti(array($key));
        } catch (\Sajari\Error\MultiRecordNotFoundException $e) {
            throw new \Sajari\Error\RecordNotFoundException($e->getMessage(), $e->getCode(), null);
        }

        return [$res[0], $status[0]];
    }

    /**
     * @param \Sajari\Record\Key[] $keys
     * @return \Sajari\Record\Record[]
     * @throws \Exception
     */
    public function GetMulti(array $keys)
    {
        $protoKeys = $this->keysToProto($keys);

        /** @var \sajari\engine\store\record\GetResponse $reply */
        list($reply, $status) = $this->storeClient->Get(
            $protoKeys,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        $this->checkForError($status);

        $docs = array();

        /** @var \sajari\engine\store\record\Record $rec */
        foreach ($reply->getRecordsList() as $rec) {
            $value = array();

            /** @var \sajari\engine\store\record\Record\ValuesEntry $m */
            foreach ($rec->getValuesList() as $v) {
                $value[] = \Sajari\Record\Value::FromProto($v->getKey(), $v->getValue());
            }

            $docs[] = new \Sajari\Record\Record($value);
        }

        $statuses = $reply->getStatusList();

        foreach ($statuses as $s) {
            if (isset($s) && $s->code === 5) {
                throw new \Sajari\Error\MultiRecordNotFoundException($s->message, $s->code, null);
            }
        }

        return [$docs, $statuses];
    }

    /**
     * @param array $keys
     * @return \sajari\engine\store\record\Keys
     */
    private function keysToProto(array $keys)
    {
        $protoKeys = new \sajari\engine\store\record\Keys();

        /** @var \Sajari\Record\Key $k */
        foreach ($keys as $k) {
            $protoKeys->addKeys($k->Proto());
        }

        return $protoKeys;
    }

    /**
     * @param \Sajari\Record\Record $rec
     * @return Key
     * @throws Exception
     */
    public function Add(\Sajari\Record\Record $rec)
    {
        $multiResult = $this->AddMulti([$rec]);

        // Return the first key and status from add multi
        return [$multiResult[0][0], $multiResult[1][0]];
    }

    /**
     * @param array $docs
     * @return array
     * @throws \Sajari\Error\Exception
     */
    public function AddMulti(array $docs)
    {
        $protoDocs = new \sajari\engine\store\record\Records();

        foreach ($docs as $d) {
            $protoDoc = new \sajari\engine\store\record\Record();
            foreach ($d->getValues() as $m) {
                $valueEntry = new \sajari\engine\store\record\Record\ValuesEntry();
                $valueEntry->setKey($m->getKey());
                $v = new \sajari\engine\Value();
                $v->setSingle($m->getValue());
                $valueEntry->setValue($v);

                $protoDoc->addValues($valueEntry);
            }

            $protoDocs->addRecords($protoDoc);
        }

        list($reply, $status) = $this->storeClient->Add(
            $protoDocs,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        $this->checkForError($status);

        $keys = array();

        /** @var $k \sajari\engine\Key */
        foreach ($reply->getKeysList() as $k) {
            $value = \Sajari\Record\Key::FromProto($k);

            $keys[] = new \Sajari\Record\Key($k->getField(), $value);
        }

        return [$keys, $reply->getStatusList()];
    }

    /**
     * @param $key
     * @return null
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
     * @param array $keys
     * @return mixed
     * @throws \Exception
     */
    public function DeleteMulti(array $keys)
    {
        $protoKeys = $this->keysToProto($keys);

        list($reply, $status) = $this->storeClient->Delete(
            $protoKeys,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        $this->checkForError($status);

        return $reply->getStatusList();
    }

    /**
     * @param $km
     * @return null
     */
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
     * @param array $kvs
     * @return mixed
     * @throws \Exception
     */
    public function PatchMulti(array $kvs)
    {
        $protoKeyValues = new \sajari\engine\store\record\KeysValues();

        foreach ($kvs as $kv) {
            $protoKeyValue = new \sajari\engine\store\record\KeysValues\KeyValues();

            $k = new \sajari\engine\Key();
            $k->setField($kv->getKey()->getField());

            $v = new \sajari\engine\Value();

            $v->setSingle($kv->getKey()->getValue());
            $k->setValue($v);

            $protoKeyValue->setKey($k);

            foreach ($kv->getValues() as $m) {
                $protoKeyValue->addValues($m->Proto());
            }

            $protoKeyValues->addKeysValues($protoKeyValue);
        }

        list($reply, $status) = $this->storeClient->Patch(
            $protoKeyValues,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        $this->checkForError($status);

        return $reply->getStatusList();
    }

    /**
     * @param \Sajari\Search\Request $r
     * @return \Sajari\Search\Response
     */
    public function Search(\Sajari\Search\Request $r)
    {
        $searchRequest = $r->Proto();
        // Make Request
        /** @var engine\query\Response $reply */
        list($reply, $status) = $this->searchClient->Search(
            $searchRequest,
            $this->getCallMeta()
        )->wait();

        // Check for server error
        $this->checkForError($status);

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

        $protoResponseList = $response->getResultsList();

        foreach ($protoResponseList as $protoResult) {
            $meta = array();

            foreach ($protoResult->getValuesList() as $m) {
                $meta[] = \Sajari\Record\Value::FromProtoValue($m->getKey(), $m->getValue());
            }

            $result = new \Sajari\Search\Result (
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
                    $bucketArray[$b->getName()] = new \Sajari\Search\BucketResponseAggregate($b->getName(), $b->getCount());
                }

                $aggregateList[$a->getKey()] = $bucketArray;
            } elseif ($ar->hasCount()) {
                /** @var engine\query\AggregateResponse\Count $counts */
                $counts = $ar->getCount();

                $countArray = array();

                /** @var engine\query\AggregateResponse\Count\CountsEntry $ce */
                foreach ($counts->getCountsList() as $ce) {
                    $countArray[$ce->getKey()] = new \Sajari\Search\CountResponseAggregate($ce->getKey(), $ce->getValue());
                }

                $aggregateList[$a->getKey()] = $countArray;
            } elseif ($ar->hasMetric()) {
                /** @var engine\query\AggregateResponse\Metric */
                $m = $ar->getMetric();

                $aggregateList[$a->getKey()] = new \Sajari\Search\MetricResponseAggregate($m->getValue());
            }
        }

        $tokens = [];
        if ($reply->hasTokens()) {
          foreach ($reply->getTokensList() as $protoToken) {
            $token = NULL;
            if ($protoToken->hasClick()) {
              $token = new \Sajari\Search\ClickToken($protoToken->getClick()->getClick());
            } else {
              $token = new \Sajari\Search\PosNegToken(
                $protoToken->getPosNeg()->getPos(),
                $protoToken->getPosNeg()->getNeg()
              );
            }
            $tokens[] = $token;
          }
        }

        return new \Sajari\Search\Response($total, $reads, $time, $results, $aggregateList, $tokens);
    }

    /**
     * @param $status
     * @throws \Sajari\Error\AlreadyExistsException
     * @throws \Sajari\Error\Base
     * @throws \Sajari\Error\MalformedRequestException
     * @throws \Sajari\Error\NotFoundException
     * @throws \Sajari\Error\PermissionDeniedException
     * @throws \Sajari\Error\Unauthenticated
     * @throws \Sajari\Error\Unavailable
     */
    private function checkForError($status)
    {
        switch ($status->code) {
            case 0:
                return;
            case 3:
                // invalid argument
                throw new \Sajari\Error\MalformedRequestException($status->details, $status->code);
            case 5:
                // not found
                throw new \Sajari\Error\NotFoundException($status->details, $status->code);
            case 6:
                // already exists
                throw new \Sajari\Error\AlreadyExistsException($status->details, $status->code);
            case 7:
                // permission denied
                throw new \Sajari\Error\PermissionDeniedException($status->details, $status->code);
            case 14:
                // unavailable
                throw new \Sajari\Error\Unavailable($status->details, $status->code);
            case 16:
                // unauthenticated
                throw new \Sajari\Error\Unauthenticated($status->details, $status->code);;
            default:
                // generic exception
                throw new \Sajari\Error\Base($status->details, $status->code);
        }
    }
}
