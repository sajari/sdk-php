<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\Aggregate\Count as ProtoCount;
use sajari\engine\query\Aggregate as ProtoAggregate;
use sajari\engine\query\Request\AggregatesEntry as ProtoAggregatesEntry;

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
        $ca = new ProtoCount();
        $ca->setField($this->field);

        $a = new ProtoAggregate();
        $a->setCount($ca);

        $ae = new ProtoAggregatesEntry();
        $ae->setKey($this->name);
        $ae->setValue($a);
        return $ae;
    }
}
