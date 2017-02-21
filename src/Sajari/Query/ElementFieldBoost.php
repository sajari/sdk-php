<?php

namespace Sajari\Query;

/**
 * Class ElementFieldBoost
 * @package Sajari\Query
 */
class ElementFieldBoost implements FieldBoost, \Sajari\Misc\Proto
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
     * @return \sajariGen\engine\query\v1\FieldBoost
     */
    public function Proto()
    {
        $emb = new \sajariGen\engine\query\v1\FieldBoost\Element();
        $emb->setField($this->field);
        foreach ($this->elements as $element) {
            $emb->addElts($element);
        }

        $mb = new \sajariGen\engine\query\v1\FieldBoost();
        $mb->setElement($emb);
        return $mb;
    }
}
