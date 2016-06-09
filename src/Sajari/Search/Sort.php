<?php

namespace Sajari\Search;

/**
 * @param $field
 * @return Sort
 */
function Asc($field)
{
    return new Sort($field, Sort::ASC);
}

/**
 * @param $field
 * @return Sort
 */
function Desc($field)
{
    return new Sort($field, Sort::DESC);
}

class Sort
{
    const ASC = 0;
    const DESC = 1;
    /** @var string $field */
    private $field;
    /** @var int $order */
    private $order;

    /**
     * Sort constructor.
     * @param string $field
     * @param $order
     */
    public function __construct($field, $order)
    {
        $this->field = $field;
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return engine\query\Sort
     */
    public function Proto()
    {
        $s = new engine\query\Sort();
        $s->setField($this->field);
        $s->setOrder($this->order);
        return $s;
    }
}