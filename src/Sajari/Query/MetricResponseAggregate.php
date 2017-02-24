<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class MetricResponseAggregate
 * @package Sajari\Query
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
