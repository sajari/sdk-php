<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\Request\AggregatesEntry as ProtoAggregatesEntry;
use sajari\engine\query\Aggregate\Metric as ProtoMetric;
use sajari\engine\query\Aggregate as ProtoAggregate;

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

    public static function Avg($field, $name)
    {
        return new MetricAggregate($field, MetricAggregate::AVG, $name);
    }

    public static function Min($field, $name)
    {
        return new MetricAggregate($field, MetricAggregate::MIN, $name);
    }

    public static function Max($field, $name)
    {
        return new MetricAggregate($field, MetricAggregate::MAX, $name);
    }

    public static function Sum($field, $name)
    {
        return new MetricAggregate($field, MetricAggregate::SUM, $name);
    }

    public function Proto()
    {
        $ae = new ProtoAggregatesEntry();
        $ae->setKey($this->name);

        $ma = new ProtoMetric();
        $ma->setField($this->field);
        $ma->setType($this->type);

        $a = new ProtoAggregate();
        $a->setMetric($ma);

        $ae->setValue($a);
        return $ae;
    }
}
