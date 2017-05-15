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
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $description
     * @return Field
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param int $type
     * @return Field
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param bool $repeated
     * @return Field
     */
    public function setRepeated($repeated)
    {
        $this->repeated = $repeated;
        return $this;
    }

    /**
     * @param bool $required
     * @return Field
     */
    public function setRequired($required)
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @param bool $store
     * @return Field
     */
    public function setStore($store)
    {
        $this->store = $store;
        return $this;
    }

    /**
     * @param bool $indexed
     * @return Field
     */
    public function setIndexed($indexed)
    {
        $this->indexed = $indexed;
        return $this;
    }

    /**
     * @param bool $unique
     * @return Field
     */
    public function setUnique($unique)
    {
        $this->unique = $unique;
        return $this;
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
