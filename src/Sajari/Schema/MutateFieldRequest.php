<?php

namespace Sajari\Schema;

/**
 * Class MutateFieldRequest
 * @package Sajari\Schema
 */
class MutateFieldRequest implements \Sajari\Engine\Proto
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
     * @return \sajariGen\engine\schema\MutateFieldRequest
     */
    public function Proto()
    {
        $r = new \sajariGen\engine\schema\MutateFieldRequest();
        $r->setName($this->name);
        foreach ($this->mutations as $mutation) {
            $r->addMutations($mutation->Proto());
        }
        return $r;
    }
}