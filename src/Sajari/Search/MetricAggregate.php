<?php

namespace Sajari\Search;

function AvgMetricAggregate($field, $name)
{
    return new MetricAggregate($field, MetricAggregate::AVG, $name);
}

function MinMetricAggregate($field, $name)
{
    return new MetricAggregate($field, MetricAggregate::MIN, $name);
}

function MaxMetricAggregate($field, $name)
{
    return new MetricAggregate($field, MetricAggregate::MAX, $name);
}

function SumMetricAggregate($field, $name)
{
    return new MetricAggregate($field, MetricAggregate::SUM, $name);
}

class MetricAggregate extends Aggregate
{
    const AVG = 0;
    const MIN = 1;
    const MAX = 2;
    const SUM = 3;
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
     * @return mixed
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

    public function Proto()
    {
        $ae = new engine\query\Request\AggregatesEntry();
        $ae->setKey($this->name);

        $ma = new engine\query\Aggregate\Metric();
        $ma->setField($this->field);
        $ma->setType($this->type);

        $a = new engine\query\Aggregate();
        $a->setMetric($ma);

        $ae->setValue($a);
        return $ae;
    }
}