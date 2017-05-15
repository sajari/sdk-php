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
            $fb = [];
            foreach ($this->fieldBoosts as $b) {
                $fb[] = $b->proto();
            }
            $fq->setFieldBoosts(\Sajari\Internal\Utils::MakeRepeated($fb, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Query\V1\SearchRequest_FeatureQuery_FieldBoost::class));
        }

        return $fq;
    }
}
