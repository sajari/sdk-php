<?php

namespace Sajari\Search;

class WeightedBody
{
    /** @var string $body */
    private $body;
    /** @var float $weight */
    private $weight;

    /**
     * WeightedBody constructor.
     * @param string $body
     * @param float $weight
     */
    public function __construct($body, $weight)
    {
        $this->body = $body;
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return engine\query\WeightedBody
     */
    public function Proto()
    {
        $wb = new engine\query\WeightedBody();
        $wb->setBody($this->body);
        $wb->setWeight($this->weight);
        return $wb;
    }
}