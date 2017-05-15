<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class FeatureFieldBoost
 * @package Sajari\Query
 */
class FeatureFieldBoost implements \Sajari\Internal\Proto
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
    public function proto()
    {
        $fb = new \Sajari\Engine\Query\V1\SearchRequest_FeatureQuery_FieldBoost();

        $fb->setFieldBoost($this->fieldBoost->proto());
        $fb->setValue($this->value);

        return $fb;
    }
}
