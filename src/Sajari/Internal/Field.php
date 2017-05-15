<?php

namespace Sajari\Internal;

class Field
{
    /**
     * @param \Sajari\Engine\Schema\Field $field
     * @return \Sajari\Field
     */
    public static function fromProto(\Sajari\Engine\Schema\Field $field)
    {
        // values corresponding to type "string" come back as null, so we have to convert to int to get 0, the expected value
        $type = Field::typeFromProto($field->getType());
        $f = new \Sajari\Field($field->getName(), $type);
        $f->setDescription($field->getDescription());
        $f->setRepeated($field->getRepeated());
        $f->setRequired($field->getRequired());
        $f->setStore($field->getStore());
        $f->setIndexed($field->getIndexed());
        $f->setUnique($field->getUnique());
        return $f;
    }

    /**
     * @param int $protoType type
     * @return string
     */
    public static function protoFromType($protoType) {
        switch ($protoType) {
            case \Sajari\Field::STRING:
                return \Sajari\Engine\Schema\Field_Type::STRING;
            case \Sajari\Field::INTEGER:
                return \Sajari\Engine\Schema\Field_Type::INTEGER;
            case \Sajari\Field::FLOAT:
                return \Sajari\Engine\Schema\Field_Type::FLOAT;
            case \Sajari\Field::BOOLEAN:
                return \Sajari\Engine\Schema\Field_Type::BOOLEAN;
            case \Sajari\Field::TIMESTAMP:
                return \Sajari\Engine\Schema\Field_Type::TIMESTAMP;
        }
        trigger_error(E_ERROR, sprintf("invalid field type: %s", $protoType));
    }

    /**
     * @param string $type Name of type.
     */
    public static function typeFromProto($type) {
        switch ($type) {
            case \Sajari\Engine\Schema\Field_Type::STRING:
                return \Sajari\Field::STRING;
            case \Sajari\Engine\Schema\Field_Type::INTEGER:
                return \Sajari\Field::INTEGER;
            case \Sajari\Engine\Schema\Field_Type::FLOAT:
                return \Sajari\Field::FLOAT;
            case \Sajari\Engine\Schema\Field_Type::BOOLEAN:
                return \Sajari\Field::BOOLEAN;
            case \Sajari\Engine\Schema\Field_Type::TIMESTAMP:
                return \Sajari\Field::TIMESTAMP;
        }
        trigger_error(E_ERROR, sprintf("invalid field type: %s", $type));
    }

    /**
     * @return \Sajari\Engine\Schema\Field
     */
    public static function toProto(\Sajari\Field $field)
    {
        $f = new \Sajari\Engine\Schema\Field();
        $f->setName($field->getName());
        $f->setDescription($field->getDescription());
        $f->setType(Field::protoFromType($field->getType()));
        $f->setRepeated($field->isRepeated());
        $f->setRequired($field->isRequired());
        $f->setStore($field->isStore());
        $f->setIndexed($field->isIndexed());
        $f->setUnique($field->isUnique());
        return $f;
    }
}