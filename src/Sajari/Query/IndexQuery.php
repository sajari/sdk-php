<?php

namespace Sajari\Query;

class IndexQuery implements \Sajari\Misc\Proto
{

    /** @var Body[] body */
    private $body;

    /** @var InstanceBoost[] instanceBoosts */
    private $instanceBoosts;

    /** @var FieldBoost[] fieldBoosts */
    private $fieldBoosts;

    /**
     * @param Body[] $body
     * @return $this
     */
    public function setBody(array $body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param InstanceBoost[] $instanceBoosts
     * @return $this
     */
    public function setInstanceBoosts(array $instanceBoosts)
    {
        $this->instanceBoosts = $instanceBoosts;
        return $this;
    }

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
     * @return \sajariGen\engine\query\v1\SearchRequest\IndexQuery
     */
    public function Proto()
    {
        $fq = new \Sajari\Engine\Query\V1\SearchRequest_IndexQuery();

        // Body
        if (isset($this->body)) {
            foreach ($this->body as $b) {
                $fq->addBody($b->Proto());
            }
        }

        // InstanceBoosts
        if (isset($this->instanceBoosts)) {
            foreach ($this->instanceBoosts as $b) {
                $fq->addInstanceBoosts($b->Proto());
            }
        }

        // FieldBoosts
        if (isset($this->fieldBoosts)) {
            $fbs = [];
            foreach ($this->fieldBoosts as $b) {
                $fbs[] = $b->Proto();
            }
            $fq->setFieldBoosts($fbs);
        }

        return $fq;
    }
}
