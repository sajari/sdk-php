<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

class IndexQuery implements Proto
{

    /** @var Body[] body */
    private $body;

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
     * @return \sajari\engine\query\v1\SearchRequest\IndexQuery
     */
    public function Proto()
    {
        $fq = new \sajari\engine\query\v1\SearchRequest\IndexQuery();

        // Body
        if (isset($this->body)) {
            foreach ($this->body as $b) {
                $fq->addBody($b->Proto());
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
