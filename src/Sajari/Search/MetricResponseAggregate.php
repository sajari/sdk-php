<?php

namespace Sajari\Search;

/**
 * Class MetricResponseAggregate
 * @package Sajari\Search
 */
class MetricResponseAggregate
{
    /** @var float $value */
    private $value;

    /**
     * MetricResponseAggregate constructor.
     * @param float $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}
