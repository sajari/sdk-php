<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\FieldBoost\Additive as ProtoAdditive;
use sajari\engine\query\FieldBoost as ProtoFieldBoost;

class AdditiveFieldBoost extends FieldBoost
{
    /** @var FieldBoost $fieldBoost */
    private $fieldBoost;
    /** @var float $value */
    private $value;

    /**
     * AdditiveFieldBoost constructor.
     * @param FieldBoost $fieldBoost
     * @param $value
     */
    public function __construct(FieldBoost $fieldBoost, $value)
    {
        $this->fieldBoost = $fieldBoost;
        $this->value = $value;
    }

    /**
     * @return FieldBoost
     */
    public function getFieldBoost()
    {
        return $this->fieldBoost;
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
        $amb = new ProtoAdditive();
        $amb->setFieldBoost($this->fieldBoost->Proto());
        $amb->setValue($this->value);

        $mb = new ProtoFieldBoost();
        $mb->setAdditive($amb);
        return $mb;
    }
}
