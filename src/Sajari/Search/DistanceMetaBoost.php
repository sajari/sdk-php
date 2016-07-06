<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\MetaBoost\Distance as ProtoDistance;
use sajari\engine\query\MetaBoost as ProtoMetaBoost;

class DistanceMetaBoost
{
    /** @var float $min */
    private $min;
    /** @var $float $max */
    private $max;
    /** @var float $ref */
    private $ref;
    /** @var string $field */
    private $field;
    /** @var float $value */
    private $value;

    /**
     * DistanceMetaBoost constructor.
     * @param float $min
     * @param float $max
     * @param float $ref
     * @param string $field
     * @param float $value
     */
    public function __construct($min, $max, $ref, $field, $value)
    {
        $this->min = $min;
        $this->max = $max;
        $this->ref = $ref;
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return mixed
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return float
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    public function Proto()
    {
        $dmb = new ProtoDistance();
        $dmb->setMin($this->min);
        $dmb->setMax($this->max);
        $dmb->setRef($this->ref);
        $dmb->setField($this->field);
        $dmb->setValue($this->value);

        $mb = new ProtoMetaBoost();
        $mb->setDistance($dmb);
        return $mb;
    }
}
