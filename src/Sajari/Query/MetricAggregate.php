<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class MetricAggregate
 * @package Sajari\Query
 */
class MetricAggregate implements Aggregate, Proto
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
        return new MetricAggregate($field, \sajariGen\engine\query\v1\Aggregate\Metric\Type::AVG, $name);
    }

    /**
     * @param string $field
     * @param string $name
     * @return MetricAggregate
     */
    public static function Min($field, $name)
    {
        return new MetricAggregate($field, \sajariGen\engine\query\v1\Aggregate\Metric\Type::MIN, $name);
    }

    /**
     * @param string $field
     * @param string $name
     * @return MetricAggregate
     */
    public static function Max($field, $name)
    {
        return new MetricAggregate($field, \sajariGen\engine\query\v1\Aggregate\Metric\Type::MAX, $name);
    }

    /**
     * @param string $field
     * @param string $name
     * @return MetricAggregate
     */
    public static function Sum($field, $name)
    {
        return new MetricAggregate($field, \sajariGen\engine\query\v1\Aggregate\Metric\Type::SUM, $name);
    }

    /**
     * @return \sajariGen\engine\query\v1\SearchRequest\AggregatesEntry
     */
    public function Proto()
    {
        $ae = new \sajariGen\engine\query\v1\SearchRequest\AggregatesEntry();
        $ae->setKey($this->name);

        $ma = new \sajariGen\engine\query\v1\Aggregate\Metric();
        $ma->setField($this->field);
        $ma->setType($this->type);

        $a = new \sajariGen\engine\query\v1\Aggregate();
        $a->setMetric($ma);

        $ae->setValue($a);
        return $ae;
    }
}