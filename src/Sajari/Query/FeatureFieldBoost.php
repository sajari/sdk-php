<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class FeatureFieldBoost
 * @package Sajari\Query
 */
class FeatureFieldBoost implements \Sajari\Engine\Proto
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
     * @return \sajariGen\engine\query\v1\SearchRequest\FeatureQuery\FieldBoost
     */
    public function Proto()
    {
        $fb = new \sajariGen\engine\query\v1\SearchRequest\FeatureQuery\FieldBoost();

        $fb->setFieldBoost($this->fieldBoost->Proto());
        $fb->setValue($this->value);

        return $fb;
    }
}