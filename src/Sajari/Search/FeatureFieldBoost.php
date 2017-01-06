<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class FeatureFieldBoost
 * @package Sajari\Search
 */
class FeatureFieldBoost implements Proto
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
     * @return \sajari\engine\query\v1\SearchRequest\FeatureQuery\FieldBoost
     */
    public function Proto()
    {
        $fb = new \sajari\engine\query\v1\SearchRequest\FeatureQuery\FieldBoost();

        $fb->setFieldBoost($this->fieldBoost->Proto());
        $fb->setValue($this->value);

        return $fb;
    }
}
