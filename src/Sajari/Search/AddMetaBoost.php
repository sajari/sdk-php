<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\MetaBoost\Add as ProtoAdd;
use sajari\engine\query\MetaBoost as ProtoMetaBoost;

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
        $amb = new ProtoAdd();
        $amb->setMetaBoost($this->metaBoost);
        $amb->setValue($this->value);

        $mb = new ProtoMetaBoost();
        $mb->setAdd($amb);
        return $mb;
    }
}
