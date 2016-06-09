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

    /**
     * Response constructor.
     * @param int $totalResults
     * @param int $reads
     * @param string $time
     * @param Result[] $results
     * @param ResultAggregate[] $aggregates
     */
    public function __construct($totalResults, $reads, $time, array $results, array $aggregates)
    {
        $this->totalResults = $totalResults;
        $this->reads = $reads;
        $this->time = $time;
        $this->results = $results;
        $this->aggregates = $aggregates;
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

}