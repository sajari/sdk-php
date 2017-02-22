<?php

namespace Sajari\Query;

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
    /** @var BucketResponseAggregate|CountResponseAggregate|MetricResponseAggregate[] $aggregates */
    private $aggregates;
    /** @var array $tokens */
    private $tokens;

    /**
     * Response constructor.
     * @param int $totalResults
     * @param int $reads
     * @param string $time
     * @param Result[] $results
     * @param BucketResponseAggregate|CountResponseAggregate|MetricResponseAggregate[] $aggregates
     * @param ClickToken|PosNegToken[] $tokens
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
     * Returns an associative array of Name -> Aggregate
     * @return array[string]BucketResponseAggregate|CountResponseAggregate|MetricResponseAggregate
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
     * @param \sajariGen\engine\query\v1\SearchResponse $protoResponse
     * @param \sajariGen\api\query\v1\Token[] $protoTokens
     * @return Response
     */
    public static function FromProto(\Sajari\Engine\Query\V1\SearchResponse $protoResponse, array $protoTokens)
    {
        $reads = $protoResponse->getReads();
        $time = $protoResponse->getTime();
        $total = $protoResponse->getTotalResults();

        $results = array();

        $protoResponseList = $protoResponse->getResults();

        foreach ($protoResponseList as $protoResult) {
            $values = array();
            foreach ($protoResult->getValues() as $k => $m) {
                $tv = $m->getValue()->getValue();
                if ($tv instanceof \Sajari\Engine\Value_Repeated) {
                    $arr = [];
                    foreach ($tv->getValues() as $value) {
                        $arr[] = $value;
                    }
                    $values[$k] = $arr;
                } else {
                    $values[$k] = $tv;
                }
            }
            $result = new Result (
                $protoResult->getScore(),
                $protoResult->getIndexScore(),
                $values
            );
            $results[] = $result;
        }

        $protoAggregateList = $protoResponse->getAggregates();

        $aggregateList = array();
        foreach ($protoAggregateList as $a) {
            $ar = $a->getValue();
            if ($ar->hasBuckets()) {
                $buckets = $ar->getBuckets();
                $bucketArray = array();
                foreach ($buckets->getBucketsList() as $be) {
                    $b = $be->getValue();
                    $bucketArray[$b->getName()] = new BucketResponseAggregate($b->getName(), $b->getCount());
                }
                $aggregateList[$a->getKey()] = $bucketArray;
            } elseif ($ar->hasCount()) {
                $counts = $ar->getCount();
                $countArray = array();
                foreach ($counts->getCountsList() as $ce) {
                    $countArray[$ce->getKey()] = new CountResponseAggregate($ce->getKey(), $ce->getValue());
                }
                $aggregateList[$a->getKey()] = $countArray;
            } elseif ($ar->hasMetric()) {
                $m = $ar->getMetric();
                $aggregateList[$a->getKey()] = new MetricResponseAggregate($m->getValue());
            }
        }

        $tokens = [];
        if (isset($protoTokens)) {
            foreach ($protoTokens as $protoToken) {
                if ($protoToken->hasClick()) {
                    $tokens[] = new ClickToken($protoToken->getClick()->getToken());
                } else {
                    $tokens[] = new PosNegToken(
                        $protoToken->getPosNeg()->getPos(),
                        $protoToken->getPosNeg()->getNeg()
                    );
                }
            }
        }

        return new Response($total, $reads, $time, $results, $aggregateList, $tokens);
    }
}
