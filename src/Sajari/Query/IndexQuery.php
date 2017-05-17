<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

class IndexQuery implements \Sajari\Internal\Proto
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
     * @return \Sajari\Engine\Query\V1\SearchRequest\IndexQuery
     */
    public function proto()
    {
        $fq = new \Sajari\Engine\Query\V1\SearchRequest_IndexQuery();

        // Body
        if (isset($this->body)) {
            foreach ($this->body as $b) {
                $fq->getBody()[] = $b->proto();
            }
        }

        // InstanceBoosts
        if (isset($this->instanceBoosts)) {
            foreach ($this->instanceBoosts as $b) {
                $fq->getInstanceBoosts()[] = $b->proto();
            }
        }

        // FieldBoosts
        if (isset($this->fieldBoosts)) {
            foreach ($this->fieldBoosts as $b) {
                $fq->getFieldBoosts()[] = $b->proto();
            }
        }

        return $fq;
    }
}
