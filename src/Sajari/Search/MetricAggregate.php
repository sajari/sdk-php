<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\Aggregate as EngineAggregate;
use sajari\engine\query\v1\Aggregate\Metric as EngineMetric;
use sajari\engine\query\v1\Aggregate\Metric\Type;
use sajari\engine\query\v1\Request\AggregatesEntry as EngineAggregatesEntry;

class MetricAggregate extends Aggregate
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
        return new MetricAggregate($field, Type::AVG, $name);
    }

    public static function Min($field, $name)
    {
        return new MetricAggregate($field, Type::MIN, $name);
    }

    public static function Max($field, $name)
    {
        return new MetricAggregate($field, Type::MAX, $name);
    }

    public static function Sum($field, $name)
    {
        return new MetricAggregate($field, Type::SUM, $name);
    }

    public function Proto()
    {
        $ae = new EngineAggregatesEntry();
        $ae->setKey($this->name);

        $ma = new EngineMetric();
        $ma->setField($this->field);
        $ma->setType($this->type);

        $a = new EngineAggregate();
        $a->setMetric($ma);

        $ae->setValue($a);
        return $ae;
    }
}
