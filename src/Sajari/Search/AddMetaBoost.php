<?php

namespace Sajari\Search;

class AddMetaBoost extends MetaBoost
{
    /** @var MetaBoost $metaBoost */
    private $metaBoost;
    /** @var float $value */
    private $value;

    /**
     * AddMetaBoost constructor.
     * @param MetaBoost $metaBoost
     * @param $value
     */
    public function __construct(MetaBoost $metaBoost, $value)
    {
        $this->metaBoost = $metaBoost;
        $this->value = $value;
    }

    /**
     * @return MetaBoost
     */
    public function getMetaBoost()
    {
        return $this->metaBoost;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function Proto()
    {
        $amb = new engine\query\MetaBoost\Add();
        $amb->setMetaBoost($this->metaBoost);
        $amb->setValue($this->value);

        $mb = new engine\query\MetaBoost();
        $mb->setAdd($amb);
        return $mb;
    }
}