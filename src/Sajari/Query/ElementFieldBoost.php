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
     * @return \Sajari\Engine\Query\V1\FieldBoost
     */
    public function Proto()
    {
        $emb = new \Sajari\Engine\Query\V1\FieldBoost_Element();
        $emb->setField($this->field);

        $elts = [];
        foreach ($this->elements as $element) {
            $elts[] = $element;
        }
        $emb->setElts(\Sajari\Misc\Utils::MakeRepeated($elts, \Google\Protobuf\Internal\GPBType::STRING));

        $mb = new \Sajari\Engine\Query\V1\FieldBoost();
        $mb->setElement($emb);
        return $mb;
    }
}
