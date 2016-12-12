<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\SearchRequest\IndexQuery as EngineIndexQuery;

class IndexQuery
{

    /** @var Body[] body */
    private $body;

    /** @var Term[] terms */
    private $terms;

    /** @var InstanceBoost[] instanceBoosts */
    private $instanceBoosts;

    /** @var FieldBoost[] fieldBoosts */
    private $fieldBoosts;

    /**
     * @param Body[] $body
     */
    public function setBody(array $body)
    {
        $this->body = $body;
    }

    /**
     * @param Term[] $terms
     */
    public function setTerms(array $terms)
    {
        $this->terms = $terms;
    }

    /**
     * Proto returns the proto representation of a IndexQuery
     *
     * @return EngineIndexQuery
     */
    public function Proto()
    {
        $fq = new EngineIndexQuery();

        if (isset($this->body)) {
            foreach ($this->body as $b) {
                $fq->addBody($b->Proto());
            }
        }

        if (isset($this->terms)) {
            foreach ($this->terms as $t) {
                $fq->addTerms($t->Proto());
            }
        }

        return $fq;
    }
}
