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
