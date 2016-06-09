<?php

namespace Sajari\Search;

/**
 * @param string $field
 * @return CountAggregate
 */
function Count($field, $name)
{
    return new CountAggregate($field, $name);
}

class CountAggregate extends Aggregate
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

    public function Proto()
    {
        $ca = new engine\query\Aggregate\Count();
        $ca->setField($this->field);

        $a = new engine\query\Aggregate();
        $a->setCount($ca);

        $ae = new engine\query\Request\AggregatesEntry();
        $ae->setKey($this->name);
        $ae->setValue($a);
        return $ae;
    }
}