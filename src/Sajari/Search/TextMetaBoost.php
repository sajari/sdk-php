<?php

namespace Sajari\Search;

class TextMetaBoost
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

    public function Proto()
    {
        $tmb = new engine\query\MetaBoost\Text();
        $tmb->setField($this->field);
        $tmb->setText($this->text);

        $mb = new engine\query\MetaBoost();
        $mb->setText($tmb);
        return $mb;
    }
}