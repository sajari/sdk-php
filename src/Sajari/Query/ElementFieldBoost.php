<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class ElementFieldBoost
 * @package Sajari\Query
 */
class ElementFieldBoost implements FieldBoost, \Sajari\Internal\Proto
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
    public function proto()
    {
        $emb = new \Sajari\Engine\Query\V1\FieldBoost_Element();
        $emb->setField($this->field);

        foreach ($this->elements as $element) {
            $emb->getElts()[] = $element;
        }

        $mb = new \Sajari\Engine\Query\V1\FieldBoost();
        $mb->setElement($emb);
        return $mb;
    }
}
