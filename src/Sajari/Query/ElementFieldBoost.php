<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class ElementFieldBoost
 * @package Sajari\Query
 */
class ElementFieldBoost implements FieldBoost, Proto
{
    /** @var string $field */
    private $field;
    /** @var string[] $elements */
    private $elements;

    /**
     * ElementFieldBoost constructor.
     * @param string $field
     * @param string[] $elements
     */
    public function __construct($field, array $elements)
    {
        $this->field = $field;
        $this->elements = $elements;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return string[]
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @return \sajari\engine\query\v1\FieldBoost
     */
    public function Proto()
    {
        $emb = new \sajari\engine\query\v1\FieldBoost\Element();
        $emb->setField($this->field);
        foreach ($this->elements as $element) {
            $emb->addElts($element);
        }

        $mb = new \sajari\engine\query\v1\FieldBoost();
        $mb->setElement($emb);
        return $mb;
    }
}
