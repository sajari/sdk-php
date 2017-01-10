<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class Sort
 * @package Sajari\Query
 */
class Sort implements \Sajari\Engine\Proto
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
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $field
     * @return Sort
     */
    public static function Asc($field)
    {
        return new Sort($field, \sajariGen\engine\query\v1\Sort\Order::ASC);
    }

    /**
     * @param string $field
     * @return Sort
     */
    public static function Desc($field)
    {
        return new Sort($field, \sajariGen\engine\query\v1\Sort\Order::DESC);
    }

    /**
     * @return \sajariGen\engine\query\v1\Sort
     */
    public function Proto()
    {
        $s = new \sajariGen\engine\query\v1\Sort();
        $s->setField($this->field);
        $s->setOrder($this->order);
        return $s;
    }
}
