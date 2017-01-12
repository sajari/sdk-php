<?php

namespace Sajari\Schema;

/**
 * Class Field
 * @package Sajari\Schema
 */
class Field implements \Sajari\Engine\Proto
{
    public static $STRING = \sajariGen\engine\schema\Field\Type::STRING;
    public static $INTEGER = \sajariGen\engine\schema\Field\Type::INTEGER;
    public static $FLOAT = \sajariGen\engine\schema\Field\Type::FLOAT;
    public static $BOOLEAN = \sajariGen\engine\schema\Field\Type::BOOLEAN;
    public static $TIMESTAMP = \sajariGen\engine\schema\Field\Type::TIMESTAMP;

    /** @var int $id */
    private $id;

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

    /** @var boolean $store */
    private $store;

    /** @var boolean $indexed */
    private $indexed;

    /** @var boolean $unique */
    private $unique;

    /**
     * Field constructor.
     * @param int $id
     * @param string $name
     * @param string $description
     * @param int $type
     * @param boolean $repeated
     * @param boolean $required
     * @param boolean $store
     * @param boolean $indexed
     * @param boolean $unique
     */
    public function __construct($id, $name, $description, $type, $repeated, $required, $store, $indexed, $unique)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->repeated = $repeated;
        $this->required = $required;
        $this->store = $store;
        $this->indexed = $indexed;
        $this->unique = $unique;
    }

    /**
     * @param \sajariGen\engine\schema\Field $field
     * @return Field
     */
    public static function FromProto(\sajariGen\engine\schema\Field $field)
    {
        return new Field(
            $field->getId(),
            $field->getName(),
            $field->getDescription(),
            intval($field->getType()), // values corresponding to type "string" come back as null, so we have to convert to int to get 0, the expected value
            $field->getRepeated(),
            $field->getRequired(),
            $field->getStore(),
            $field->getIndexed(),
            $field->getUnique()
        );
    }

    /**
     * @return \sajariGen\engine\schema\Field
     */
    public function Proto()
    {
        $field = new \sajariGen\engine\schema\Field();
        $field->setId($this->id);
        $field->setName($this->name);
        $field->setDescription($this->description);
        $field->setType($this->type);
        $field->setRepeated($this->repeated);
        $field->setRequired($this->required);
        $field->setStore($this->store);
        $field->setIndexed($this->indexed);
        $field->setUnique($this->unique);
        return $field;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @param bool $asString
     * @return int|string
     */
    public function getType($asString = false)
    {
        if ($asString) {
            switch ($this->type) {
                case self::$STRING:
                    return "string";
                case self::$INTEGER:
                    return "integer";
                case self::$FLOAT:
                    return "float";
                case self::$BOOLEAN:
                    return "boolean";
                case self::$TIMESTAMP:
                    return "timestamp";
            }
        }
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
}