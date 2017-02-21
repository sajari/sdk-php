<?php

namespace Sajari\Schema;

/**
 * Class Field
 * @package Sajari\Schema
 */
class Field implements \Sajari\Engine\Proto
{
    public static $STRING = \Sajari\Engine\Schema\Field_Type::STRING;
    public static $INTEGER = \Sajari\Engine\Schema\Field_Type::INTEGER;
    public static $FLOAT = \Sajari\Engine\Schema\Field_Type::FLOAT;
    public static $BOOLEAN = \Sajari\Engine\Schema\Field_Type::BOOLEAN;
    public static $TIMESTAMP = \Sajari\Engine\Schema\Field_Type::TIMESTAMP;

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
     * @param string $name
     * @param int $type
     */
    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @param \Sajari\Engine\Schema\Field $field
     * @return Field
     */
    public static function FromProto(\Sajari\Engine\Schema\Field $field)
    {
        // values corresponding to type "string" come back as null, so we have to convert to int to get 0, the expected value
        $f = new Field($field->getName(), intval($field->getType()));
        $f->id = $field->getId();
        $f->description = $field->getDescription();
        $f->repeated = $field->getRepeated();
        $f->required = $field->getRequired();
        $f->store = $field->getStore();
        $f->indexed = $field->getIndexed();
        $f->unique = $field->getUnique();
        return $f;
    }

    /**
     * @return \Sajari\Engine\Schema\Field
     */
    public function Proto()
    {
        $field = new \Sajari\Engine\Schema\Field();
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
        return new Field($name, Field::$STRING);
    }

    /**
     * @param string $name
     * @return Field
     */
    public static function Integer($name)
    {
        return new Field($name, Field::$INTEGER);
    }

    /**
     * @param string $name
     * @return Field
     */
    public static function Float($name)
    {
        return new Field($name, Field::$FLOAT);
    }

    /**
     * @param string $name
     * @return Field
     */
    public static function Boolean($name)
    {
        return new Field($name, Field::$BOOLEAN);
    }

    /**
     * @param string $name
     * @return Field
     */
    public static function Timestamp($name)
    {
        return new Field($name, Field::$TIMESTAMP);
    }
}
