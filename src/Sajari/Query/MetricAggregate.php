<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class MetricAggregate
 * @package Sajari\Query
 */
class MetricAggregate implements Aggregate, \Sajari\Internal\Proto
{
    /** @var string $field */
    private $field;

    /** @var int $type */
    private $type;

    /** @var string $name */
    private $name;

    /**
     * MetricAggregate constructor.
     * @param string $field
     * @param int $type
     * @param string $name
     */
    public function __construct($field, $type, $name)
    {
        $this->field = $field;
        $this->type = $type;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $field
     * @param string $name
     * @return MetricAggregate
     */
    public static function Avg($field, $name)
    {
        return new MetricAggregate($field, \Sajari\Engine\Query\V1\Aggregate_Metric_Type::AVG, $name);
    }

    /**
     * @param string $field
     * @param string $name
     * @return MetricAggregate
     */
    public static function Min($field, $name)
    {
        return new MetricAggregate($field, \Sajari\Engine\Query\V1\Aggregate_Metric_Type::MIN, $name);
    }

    /**
     * @param string $field
     * @param string $name
     * @return MetricAggregate
     */
    public static function Max($field, $name)
    {
        return new MetricAggregate($field, \Sajari\Engine\Query\V1\Aggregate_Metric_Type::MAX, $name);
    }

    /**
     * @param string $field
     * @param string $name
     * @return MetricAggregate
     */
    public static function Sum($field, $name)
    {
        return new MetricAggregate($field, \Sajari\Engine\Query\V1\Aggregate_Metric_Type::SUM, $name);
    }

    /**
     * @return \Sajari\Engine\Query\V1\SearchRequest\AggregatesEntry
     */
    public function proto()
    {
        $ae = new \Sajari\Engine\Query\V1\SearchRequest\AggregatesEntry();
        $ae->setKey($this->name);

        $ma = new \Sajari\Engine\Query\V1\Aggregate_Metric();
        $ma->setField($this->field);
        $ma->setType($this->type);

        $a = new \Sajari\Engine\Query\V1\Aggregate();
        $a->setMetric($ma);

        $ae->setValue($a);
        return $ae;
    }
}
