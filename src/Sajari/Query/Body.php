<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class Body
 * @package Sajari\Query
 */
class Body implements \Sajari\Engine\Proto
{
    /** @var string $text */
    private $text;

    /** @var float $weight */
    private $weight;

    /**
     * Body constructor.
     * @param string $text
     * @param float $weight
     */
    public function __construct($text, $weight = 1.0)
    {
        $this->text = $text;
        $this->weight = $weight;
    }

    /**
     * @return \sajariGen\engine\query\v1\Body
     */
    public function Proto() {
        $b = new \sajariGen\engine\query\v1\Body();

        $b->setText($this->text);
        $b->setWeight($this->weight);

        return $b;
    }
}
