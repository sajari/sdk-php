<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class TextFieldBoost
 * @package Sajari\Query
 */
class TextFieldBoost implements \Sajari\Internal\Proto
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
     * @return \Sajari\Engine\Query\V1\FieldBoost
     */
    public function Proto()
    {
        $tmb = new \Sajari\Engine\Query\V1\FieldBoost\Text();
        $tmb->setField($this->field);
        $tmb->setText($this->text);

        $mb = new \Sajari\Engine\Query\V1\FieldBoost();
        $mb->setText($tmb);
        return $mb;
    }
}
