<?php

namespace Sajari\Schema;

/**
 * Class MutateFieldRequest
 * @package Sajari\Schema
 */
class MutateFieldRequest implements Proto
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
     * @return \sajari\engine\schema\MutateFieldRequest
     */
    public function Proto()
    {
        $r = new \sajari\engine\schema\MutateFieldRequest();
        $r->setName($this->name);
        foreach ($this->mutations as $mutation) {
            $r->addMutations($mutation->Proto());
        }
        return $r;
    }
}