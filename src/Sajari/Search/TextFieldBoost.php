<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\FieldBoost\Text as EngineText;
use sajari\engine\query\v1\FieldBoost as EngineFieldBoost;

class TextFieldBoost
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
     * @return EngineText
     */
    public function Proto()
    {
        $tmb = new EngineText();
        $tmb->setField($this->field);
        $tmb->setText($this->text);

        $mb = new EngineFieldBoost();
        $mb->setText($tmb);
        return $mb;
    }
}
