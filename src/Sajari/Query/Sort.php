<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class Sort
 * @package Sajari\Query
 */
class Sort implements \Sajari\Internal\Proto
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
        return new Sort($field, \Sajari\Engine\Query\V1\Sort_Order::ASC);
    }

    /**
     * @param string $field
     * @return Sort
     */
    public static function Desc($field)
    {
        return new Sort($field, \Sajari\Engine\Query\V1\Sort_Order::DESC);
    }

    /**
     * @return \Sajari\Engine\Query\V1\Sort
     */
    public function proto()
    {
        $s = new \Sajari\Engine\Query\V1\Sort();
        $s->setField($this->field);
        $s->setOrder($this->order);
        return $s;
    }
}
