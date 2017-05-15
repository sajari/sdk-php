<?php

namespace Sajari\Schema;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class MutateFieldRequest
 * @package Sajari\Schema
 */
class MutateFieldRequest implements \Sajari\Internal\Proto
{
    /** @var string $name */
    private $name;

    /** @var Mutation[] $mutations */
    private $mutations;

    /**
     * MutateFieldRequest constructor.
     * @param $name
     * @param Mutation[] $mutations
     */
    public function __construct($name, array $mutations)
    {
        $this->name = $name;
        $this->mutations = $mutations;
    }

    /**
     * @return \Sajari\Engine\Schema\MutateFieldRequest
     */
    public function proto()
    {
        $r = new \Sajari\Engine\Schema\MutateFieldRequest();
        $r->setName($this->name);
        foreach ($this->mutations as $mutation) {
            $r->addMutations($mutation->proto());
        }
        return $r;
    }
}
