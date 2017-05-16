<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class FeatureQuery
 * @package Sajari\Query
 */
class FeatureQuery implements \Sajari\Internal\Proto
{
    /** @var FieldBoost[] $fieldBoosts */
    private $fieldBoosts;

    /**
     * @param FieldBoost[] $fieldBoosts
     * @return $this
     */
    public function setFieldBoosts(array $fieldBoosts)
    {
        $this->fieldBoosts = $fieldBoosts;
        return $this;
    }

    /**
     * Proto returns the proto representation of a FeatureQuery
     *
     * @return \Sajari\Engine\Query\V1\SearchRequest_FeatureQuery
     */
    public function proto()
    {
        $fq = new \Sajari\Engine\Query\V1\SearchRequest_FeatureQuery();
        if (isset($this->fieldBoosts)) {
            foreach ($this->fieldBoosts as $b) {
                $fq->getFieldBoosts()[] = $b->proto();
            }
        }
        return $fq;
    }
}
