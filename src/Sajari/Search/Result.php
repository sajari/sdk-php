<?php

namespace Sajari\Search;

use Sajari\Record\Value;

class Result
{
    /** @var double $score */
    private $score;

    /** @var double $indexScore */
    private $indexScore;

    /** @var Value[] $value */
    private $value;

    /**
     * @return Value[]
     */
    public function getValues()
    {
        return $this->value;
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
     * @param Value[] $value
     */
    public function __construct($score, $indexScore, $value)
    {
        $this->score = $score;
        $this->indexScore = $indexScore;
        $this->value = $value;
    }
}
