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
     * @return \sajariGen\engine\query\v1\SearchRequest\FeatureQuery
     */
    public function Proto()
    {
        $fq = new \sajariGen\engine\query\v1\SearchRequest\FeatureQuery();

        if (isset($this->fieldBoosts)) {
            foreach ($this->fieldBoosts as $b) {
                $fq->addFieldBoosts($b->Proto());
            }
        }

        return $fq;
    }
}
