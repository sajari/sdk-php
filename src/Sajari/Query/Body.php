<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class Body
 * @package Sajari\Query
 */
class Body implements \Sajari\Internal\Proto
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
     * @return \Sajari\Engine\Query\V1\Body
     */
    public function proto() {
        $b = new \Sajari\Engine\Query\V1\Body();

        $b->setText($this->text);
        $b->setWeight($this->weight);

        return $b;
    }
}
