<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class TextFieldBoost
 * @package Sajari\Query
 */
class TextFieldBoost implements \Sajari\Engine\Proto
{
    /** @var string $field */
    private $field;

    /** @var string $text */
    private $text;

    /**
     * TextMetaBoost constructor.
     * @param string $field
     * @param string $text
     */
    public function __construct($field, $text)
    {
        $this->field = $field;
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return \sajariGen\engine\query\v1\FieldBoost
     */
    public function Proto()
    {
        $tmb = new \sajariGen\engine\query\v1\FieldBoost\Text();
        $tmb->setField($this->field);
        $tmb->setText($this->text);

        $mb = new \sajariGen\engine\query\v1\FieldBoost();
        $mb->setText($tmb);
        return $mb;
    }
}
