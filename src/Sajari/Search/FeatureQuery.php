<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\SearchRequest\FeatureQuery as EngineFeatureQuery;

class FeatureQuery
{
    /**
     * Proto returns the proto representation of a FeatureQuery
     *
     * @return EngineFeatureQuery
     */
    public function Proto()
    {
        $fq = new EngineFeatureQuery();

        return $fq;
    }
}
