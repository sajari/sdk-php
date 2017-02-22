<?php

namespace Sajari\Query;

/**
 * Class FeatureFieldBoost
 * @package Sajari\Query
 */
class FeatureFieldBoost implements \Sajari\Misc\Proto
{
    /**
     * @var FieldBoost $fieldBoost
     */
    private $fieldBoost;

    /**
     * @var float $value
     */
    private $value;

    /**
     * @return FeatureFieldBoost
     */
    public function __construct($fieldBoost, $value)
    {
        $this->fieldBoost = $fieldBoost;
        $this->value = $value;
    }

    /**
     * @return \Sajari\Engine\Query\V1\SearchRequest_FeatureQuery_FieldBoost
     */
    public function Proto()
    {
        $fb = new \Sajari\Engine\Query\V1\SearchRequest_FeatureQuery_FieldBoost();

        $fb->setFieldBoost($this->fieldBoost->Proto());
        $fb->setValue($this->value);

        return $fb;
    }
}
