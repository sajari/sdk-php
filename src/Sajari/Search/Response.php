<?php

namespace Sajari\Search;

class Response
{
    /** @var integer $totalResults */
    private $totalResults;
    /** @var integer $reads */
    private $reads;
    /** @var string $time */
    private $time;
    /** @var Result[] $results */
    private $results;
    /** @var ResultAggregate[] $aggregates */
    private $aggregates;
    /** @var array $tokens */
    private $tokens;

    /**
     * Response constructor.
     * @param int $totalResults
     * @param int $reads
     * @param string $time
     * @param Result[] $results
     * @param ResultAggregate[] $aggregates
     */
    private function __construct($totalResults, $reads, $time, array $results, array $aggregates, array $tokens = NULL)
    {
        $this->totalResults = $totalResults;
        $this->reads = $reads;
        $this->time = $time;
        $this->results = $results;
        $this->aggregates = $aggregates;
        $this->tokens = $tokens;
    }

    /**
     * @return int
     */
    public function getTotalResults()
    {
        return $this->totalResults;
    }

    /**
     * @return int
     */
    public function getReads()
    {
        return $this->reads;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return Result[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return ResultAggregate[]
     */
    public function getAggregates()
    {
        return $this->aggregates;
    }

    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * @param \sajari\engine\query\v1\SearchResponse $protoResponse
     * @param \sajari\api\query\v1\Token[] $protoTokens
     * @return Response
     */
    public static function FromProto(\sajari\engine\query\v1\SearchResponse $protoResponse, array $protoTokens)
    {
        $reads = $protoResponse->getReads();
        $time = $protoResponse->getTime();
        $total = $protoResponse->getTotalResults();

        $results = array();

        $protoResponseList = $protoResponse->getResultsList();

        foreach ($protoResponseList as $protoResult) {
            $values = array();

            foreach ($protoResult->getValuesList() as $m) {
                $values[$m->getKey()] = \Sajari\Record\Value::FromProto($m->getValue());
            }

            $result = new \Sajari\Search\Result (
                $protoResult->getScore(),
                $protoResult->getIndexScore(),
                $values
            );

            $results[] = $result;
        }

        $protoAggregateList = $protoResponse->getAggregatesList();

        $aggregateList = array();
        foreach ($protoAggregateList as $a) {

            $ar = $a->getValue();

            if ($ar->hasBuckets()) {

                $buckets = $ar->getBuckets();

                $bucketArray = array();


                foreach ($buckets->getBucketsList() as $be) {

                    $b = $be->getValue();
                    $bucketArray[$b->getName()] = new \Sajari\Search\BucketResponseAggregate($b->getName(), $b->getCount());
                }

                $aggregateList[$a->getKey()] = $bucketArray;
            } elseif ($ar->hasCount()) {

                $counts = $ar->getCount();

                $countArray = array();


                foreach ($counts->getCountsList() as $ce) {
                    $countArray[$ce->getKey()] = new \Sajari\Search\CountResponseAggregate($ce->getKey(), $ce->getValue());
                }

                $aggregateList[$a->getKey()] = $countArray;
            } elseif ($ar->hasMetric()) {

                $m = $ar->getMetric();

                $aggregateList[$a->getKey()] = new \Sajari\Search\MetricResponseAggregate($m->getValue());
            }
        }

        $tokens = [];
        if (isset($protoTokens)) {
            foreach ($protoTokens as $protoToken) {
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
}
