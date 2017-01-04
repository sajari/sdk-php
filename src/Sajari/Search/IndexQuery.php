<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\SearchRequest\IndexQuery as EngineIndexQuery;
use Sajari\Search\FieldBoost;
use Sajari\Search\InstanceBoost;

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
     * @param InstanceBoost[] $instanceBoosts
     */
    public function setInstanceBoosts(array $instanceBoosts)
    {
        $this->instanceBoosts = $instanceBoosts;
    }

    /**
     * @param FieldBoost[] $fieldBoosts
     */
    public function setFieldBoosts(array $fieldBoosts)
    {
        $this->fieldBoosts = $fieldBoosts;
    }

    /**
     * Proto returns the proto representation of a IndexQuery
     *
     * @return EngineIndexQuery
     */
    public function Proto()
    {
        $fq = new EngineIndexQuery();

        // Body
        if (isset($this->body)) {
            foreach ($this->body as $b) {
                $fq->addBody($b->ToProto());
            }
        }

        // Terms
        if (isset($this->terms)) {
            foreach ($this->terms as $t) {
                $fq->addTerms($t->Proto());
            }
        }

        // InstanceBoosts
        if (isset($this->instanceBoosts)) {
            foreach ($this->instanceBoosts as $b) {
                $fq->addInstanceBoosts($b);
            }
        }

        // FieldBoosts
        if (isset($this->fieldBoosts)) {
            foreach ($this->fieldBoosts as $b) {
                $fq->addFieldBoosts($b);
            }
        }

        return $fq;
    }
}
