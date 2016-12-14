<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\FieldBoost\Element as EngineElement;
use sajari\engine\query\v1\FieldBoost as EngineFieldBoost;

class ElementFieldBoost extends FieldBoost
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

    public function Proto()
    {
        $emb = new EngineElement();
        $emb->setField($this->field);
        foreach ($this->elements as $element) {
            $emb->addElts($element);
        }

        $mb = new EngineFieldBoost();
        $mb->setElement($emb);
        return $mb;
    }
}
