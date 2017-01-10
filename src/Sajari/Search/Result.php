<?php

namespace Sajari\Search;

class Result
{
    /** @var double $score */
    private $score;

    /** @var double $indexScore */
    private $indexScore;

    /** @var mixed[] $values */
    private $values;

    /**
     * @return mixed[]
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return double
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @return double
     */
    public function getIndexScore()
    {
        return $this->indexScore;
    }

    /**
     * Result constructor.
     * @param float $score
     * @param float $indexScore
     * @param mixed[] $values
     */
    public function __construct($score, $indexScore, $values)
    {
        $this->score = $score;
        $this->indexScore = $indexScore;
        $this->values = $values;
    }
}
