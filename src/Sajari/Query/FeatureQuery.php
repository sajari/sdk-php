<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class FeatureQuery
 * @package Sajari\Query
 */
class FeatureQuery implements \Sajari\Engine\Proto
{
    /** @var FieldBoost[] $fieldBoosts */
    private $fieldBoosts;

    /**
     * @param FieldBoost[] $fieldBoosts
     */
    public function setFieldBoosts(array $fieldBoosts)
    {
        $this->fieldBoosts = $fieldBoosts;
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
