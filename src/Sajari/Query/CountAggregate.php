<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class CountAggregate
 * @package Sajari\Query
 */
class CountAggregate implements Aggregate, Proto
{
    /** @var string $field */
    private $field;
    /** @var string $name */
    private $name;

    /**
     * CountAggregate constructor.
     * @param string $field
     * @param $name
     */
    public function __construct($field, $name)
    {
        $this->field = $field;
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
     * @return \sajari\engine\query\v1\SearchRequest\AggregatesEntry
     */
    public function Proto()
    {
        $ca = new \sajari\engine\query\v1\Aggregate\Count();
        $ca->setField($this->field);

        $a = new \sajari\engine\query\v1\Aggregate();
        $a->setCount($ca);

        $ae = new \sajari\engine\query\v1\SearchRequest\AggregatesEntry();
        $ae->setKey($this->name);
        $ae->setValue($a);
        return $ae;
    }
}
