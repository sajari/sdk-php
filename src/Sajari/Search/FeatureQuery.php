<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\SearchRequest\FeatureQuery as EngineFeatureQuery;
use Sajari\Search\FeatureFieldBoost;

class FeatureQuery
{
    /** @var FeatureFieldBoost[] $fieldBoosts */
    private $fieldBoosts;

    public function setFieldBoosts(array $fieldBoosts)
    {
        $this->fieldBoosts = $fieldBoosts;
    }

    /**
     * Proto returns the proto representation of a FeatureQuery
     *
     * @return EngineFeatureQuery
     */
    public function Proto()
    {
        $fq = new EngineFeatureQuery();

        if (isset($this->fieldBoosts)) {
            foreach ($this->fieldBoosts as $b) {
                $fq->addFieldBoosts($b->Proto());
            }
        }

        return $fq;
    }
}
