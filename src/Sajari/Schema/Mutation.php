<?php

namespace Sajari\Schema;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class Mutation
 * @package Sajari\Schema
 */
class Mutation implements \Sajari\Internal\Proto
{
    /** @var string $name */
    private $name;

    /** @var string $description */
    private $description;

    /** @var int $type */
    private $type;

    /** @var boolean $repeated */
    private $repeated;

    /** @var boolean $required */
    private $required;

    /** @var boolean $unique */
    private $unique;

    /** @var boolean $indexed */
    private $indexed;

    /**
     * @param string $name
     * @return Mutation
     */
    public static function Name($name)
    {
        $m = new Mutation();
        $m->name = $name;
        return $m;
    }

    /**
     * @param string $description
     * @return Mutation
     */
    public static function Description($description)
    {
        $m = new Mutation();
        $m->description = $description;
        return $m;
    }

    /**
     * Use Type from Field::TYPE as argument
     * @param int $type
     * @return Mutation
     */
    public static function Type($type)
    {
        $m = new Mutation();
        $m->type = $type;
        return $m;
    }

    /**
     * @param boolean $repeated
     * @return Mutation
     */
    public static function Repeated($repeated)
    {
        $m = new Mutation();
        $m->repeated = $repeated;
        return $m;
    }

    /**
     * @param boolean $required
     * @return Mutation
     */
    public static function Required($required)
    {
        $m = new Mutation();
        $m->required = $required;
        return $m;
    }

    /**
     * @param boolean $unique
     * @return Mutation
     */
    public static function Unique($unique)
    {
        $m = new Mutation();
        $m->unique = $unique;
        return $m;
    }

    /**
     * @param boolean $indexed
     * @return Mutation
     */
    public static function Indexed($indexed)
    {
        $m = new Mutation();
        $m->indexed = $indexed;
        return $m;
    }

    private function __construct() {}

    /**
     * @return \Sajari\Engine\Schema\MutateFieldRequest\Mutation
     */
    public function proto()
    {
        $m = new \Sajari\Engine\Schema\MutateFieldRequest\Mutation();

        if (isset($this->name)) {
            $m->setName($this->name);
        }

        if (isset($this->description)) {
            $m->setDescription($this->description);
        }

        if (isset($this->type)) {
            $m->setType($this->type);
        }

        if (isset($this->repeated)) {
            $m->setRepeated($this->repeated);
        }

        if (isset($this->required)) {
            $m->setRequired($this->required);
        }

        if (isset($this->unique)) {
            $m->setUnique($this->unique);
        }

        if (isset($this->indexed)) {
            $m->setIndexed($this->indexed);
        }

        return $m;
    }
}
