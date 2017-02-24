<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class CountAggregate
 * @package Sajari\Query
 */
class CountAggregate implements Aggregate, \Sajari\Internal\Proto
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
     * @return \Sajari\Engine\Query\V1\SearchRequest\AggregatesEntry
     */
    public function Proto()
    {
        $ca = new \Sajari\Engine\Query\V1\Aggregate\Count();
        $ca->setField($this->field);

        $a = new \Sajari\Engine\Query\V1\Aggregate();
        $a->setCount($ca);

        $ae = new \Sajari\Engine\Query\V1\SearchRequest\AggregatesEntry();
        $ae->setKey($this->name);
        $ae->setValue($a);
        return $ae;
    }
}
