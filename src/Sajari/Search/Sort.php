<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\Sort as EngineSort;
use sajari\engine\query\v1\Sort\Order;

class Sort
{
    /** @var string $field */
    private $field;

    /** @var int $order */
    private $order;

    /**
     * Sort constructor.
     * @param string $field
     * @param int $order
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
     * @param $field
     * @return Sort
     */
    public static function Asc($field)
    {
        return new Sort($field, Order::ASC);
    }

    /**
     * @param $field
     * @return Sort
     */
    public static function Desc($field)
    {
        return new Sort($field, Order::DESC);
    }

    /**
     * @return EngineSort
     */
    public function Proto()
    {
        $s = new EngineSort();
        $s->setField($this->field);
        $s->setOrder($this->order);
        return $s;
    }
}
