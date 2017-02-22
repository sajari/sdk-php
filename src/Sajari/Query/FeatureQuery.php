<?php

namespace Sajari\Query;

/**
 * Class FeatureQuery
 * @package Sajari\Query
 */
class FeatureQuery implements \Sajari\Misc\Proto
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
    public function Proto()
    {
        $fq = new \Sajari\Engine\Query\V1\SearchRequest_FeatureQuery();

        if (isset($this->fieldBoosts)) {
            $fb = [];
            foreach ($this->fieldBoosts as $b) {
                $fb[] = $b->Proto();
            }
            $fq->setFieldBoosts(\Sajari\Misc\Utils::MakeRepeated($fb, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Engine\Query\V1\SearchRequest_FeatureQuery_FieldBoost::class));
        }

        return $fq;
    }
}
