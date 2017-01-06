<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class Body
 * @package Sajari\Search
 */
class Body implements Proto
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
    public function __construct($text, $weight)
    {
        $this->text = $text;
        $this->weight = $weight;
    }

    /**
     * @return \sajari\engine\query\v1\Body
     */
    public function Proto() {
        $b = new \sajari\engine\query\v1\Body();

        $b->setText($this->text);
        $b->setWeight($this->weight);

        return $b;
    }
}
