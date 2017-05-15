<?php

namespace Sajari;

/**
 * Class FieldMutation
 * @package Sajari\Schema
 */
class FieldMutations
{
    /** @var \Sajari\Engine\Schema\MutateFieldRequest\Mutation[] $mutations */
    private $mutations = [];

    /**
     * @param string $name
     * @return FieldMutation
     */
    public function setName($name)
    {
        $m = new \Sajari\Engine\Schema\MutateFieldRequest_Mutation();
        $m->setName($name);
        $this->mutations[] = $m;
        return $this;
    }

    /**
     * @param string $description
     * @return FieldMutation
     */
    public function setDescription($description)
    {
        $m = new \Sajari\Engine\Schema\MutateFieldRequest_Mutation();
        $m->setDescription($description);
        $this->mutations[] = $m;
        return $this;
    }

    /**
     * Use Type from Field::TYPE as argument
     * @param string $type
     * @return FieldMutation
     */
    public function setType($type)
    {
        $m = new \Sajari\Engine\Schema\MutateFieldRequest_Mutation();
        $m->setType(Field::typeToProto($type));
        $this->mutations[] = $m;
        return $this;
    }

    /**
     * @param boolean $repeated
     * @return FieldMutation
     */
    public function setRepeated($repeated)
    {
        $m = new \Sajari\Engine\Schema\MutateFieldRequest_Mutation();
        $m->setRepeated($repeated);
        $this->mutations[] = $m;
        return $this;
    }

    /**
     * @param boolean $required
     * @return FieldMutation
     */
    public function setRequired($required)
    {
        $m = new \Sajari\Engine\Schema\MutateFieldRequest_Mutation();
        $m->setRequired($required);
        $this->mutations[] = $m;
        return $this;
    }

    /**
     * @param boolean $unique
     * @return FieldMutation
     */
    public function setUnique($unique)
    {
        $m = new \Sajari\Engine\Schema\MutateFieldRequest_Mutation();
        $m->setUnique($unique);
        $this->mutations[] = $m;
        return $this;
    }

    /**
     * @param boolean $indexed
     * @return FieldMutation
     */
    public function setIndexed($indexed)
    {
        $m = new \Sajari\Engine\Schema\MutateFieldRequest_Mutation();
        $m->setIndexed($indexed);
        $this->mutations[] = $m;
        return $this;
    }

    /**
     * return \Sajari\Engine\Schema\MutateFieldRequest\Mutation[]
    */
    public function getMutations()
    {
        return $this->mutations;
    }
}
