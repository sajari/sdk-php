<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\Sort as ProtoSort;

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
     * @param $field
     * @return Sort
     */
    public static function Asc($field)
    {
        return new Sort($field, Sort::ASC);
    }

    /**
     * @param $field
     * @return Sort
     */
    public static function Desc($field)
    {
        return new Sort($field, Sort::DESC);
    }

    /**
     * @return engine\query\Sort
     */
    public function Proto()
    {
        $s = new ProtoSort();
        $s->setField($this->field);
        $s->setOrder($this->order);
        return $s;
    }
}
