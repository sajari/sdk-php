<?php

namespace Sajari\Search;

class Result
{
    /** @var double $score */
    private $score;
    /** @var double $rawscore */
    private $rawscore;
    /** @var Meta[] $meta */
    private $meta;

    /**
     * @return Meta[]
     */
    public function getMeta()
    {
        return $this->meta;
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
    public function getRawScore()
    {
        return $this->rawscore;
    }

    /**
     * Result constructor.
     * @param float $score
     * @param float $rawscore
     * @param Meta[] $meta
     */
    public function __construct($score, $rawscore, $meta)
    {
        $this->score = $score;
        $this->rawscore = $rawscore;
        $this->meta = $meta;
    }
}
