<?php

namespace Sajari;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class Field
 * @package Sajari
 */
class Field
{
    const STRING = "STRING";
    const INTEGER = "INTEGER";
    const FLOAT = "FLOAT";
    const BOOLEAN = "BOOLEAN";
    const TIMESTAMP = "TIMESTAMP";

    /** @var string $name */
    private $name;

    /** @var string $description */
    private $description;

    /** @var string $type */
    private $type;

    /** @var boolean $repeated */
    private $repeated;

    /** @var boolean $required */
    private $required;

    /** @var boolean $store */
    private $store;

    /** @var boolean $indexed */
    private $indexed;

    /** @var boolean $unique */
    private $unique;

    /**
     * Field constructor.
     * @param string $name
     * @param string $type
     */
    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isRepeated()
    {
        return $this->repeated;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @return bool
     */
    public function isStore()
    {
        return $this->store;
    }

    /**
     * @return bool
     */
    public function isIndexed()
    {
        return $this->indexed;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param bool $repeated
     */
    public function setRepeated($repeated)
    {
        $this->repeated = $repeated;
    }

    /**
     * @param bool $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

    /**
     * @param bool $store
     */
    public function setStore($store)
    {
        $this->store = $store;
    }

    /**
     * @param bool $indexed
     */
    public function setIndexed($indexed)
    {
        $this->indexed = $indexed;
    }

    /**
     * @param bool $unique
     */
    public function setUnique($unique)
    {
        $this->unique = $unique;
    }

    /**
     * @return bool
     */
    public function isUnique()
    {
        return $this->unique;
    }

    /**
     * @param string $name
     * @return Field
     */
    public static function String($name)
    {
        return new Field($name, Field::STRING);
    }

    /**
     * @param string $name
     * @return Field
     */
    public static function Integer($name)
    {
        return new Field($name, Field::INTEGER);
    }

    /**
     * @param string $name
     * @return Field
     */
    public static function Float($name)
    {
        return new Field($name, Field::FLOAT);
    }

    /**
     * @param string $name
     * @return Field
     */
    public static function Boolean($name)
    {
        return new Field($name, Field::BOOLEAN);
    }

    /**
     * @param string $name
     * @return Field
     */
    public static function Timestamp($name)
    {
        return new Field($name, Field::TIMESTAMP);
    }
}
