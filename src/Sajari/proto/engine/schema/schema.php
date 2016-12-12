<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 1.0
// Source: engine/schema/schema.proto
//   Date: 2016-12-12 02:45:21

namespace sajari\engine\schema {

  class Fields extends \DrSlump\Protobuf\Message {

    /**  @var \sajari\engine\schema\Field[]  */
    public $fields = array();
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.engine.schema.Fields');

      // REPEATED MESSAGE fields = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "fields";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\sajari\engine\schema\Field';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <fields> has a value
     *
     * @return boolean
     */
    public function hasFields(){
      return $this->_has(1);
    }
    
    /**
     * Clear <fields> value
     *
     * @return \sajari\engine\schema\Fields
     */
    public function clearFields(){
      return $this->_clear(1);
    }
    
    /**
     * Get <fields> value
     *
     * @param int $idx
     * @return \sajari\engine\schema\Field
     */
    public function getFields($idx = NULL){
      return $this->_get(1, $idx);
    }
    
    /**
     * Set <fields> value
     *
     * @param \sajari\engine\schema\Field $value
     * @return \sajari\engine\schema\Fields
     */
    public function setFields(\sajari\engine\schema\Field $value, $idx = NULL){
      return $this->_set(1, $value, $idx);
    }
    
    /**
     * Get all elements of <fields>
     *
     * @return \sajari\engine\schema\Field[]
     */
    public function getFieldsList(){
     return $this->_get(1);
    }
    
    /**
     * Add a new element to <fields>
     *
     * @param \sajari\engine\schema\Field $value
     * @return \sajari\engine\schema\Fields
     */
    public function addFields(\sajari\engine\schema\Field $value){
     return $this->_add(1, $value);
    }
  }
}

namespace sajari\engine\schema\Field {

  class Type extends \DrSlump\Protobuf\Enum {
    const STRING = 0;
    const INTEGER = 1;
    const FLOAT = 2;
    const BOOLEAN = 3;
    const TIMESTAMP = 4;
  }
}
namespace sajari\engine\schema {

  class Field extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $id = null;
    
    /**  @var string */
    public $name = null;
    
    /**  @var string */
    public $description = null;
    
    /**  @var int - \sajari\engine\schema\Field\Type */
    public $type = null;
    
    /**  @var boolean */
    public $repeated = null;
    
    /**  @var boolean */
    public $required = null;
    
    /**  @var boolean */
    public $store = null;
    
    /**  @var boolean */
    public $indexed = null;
    
    /**  @var boolean */
    public $unique = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.engine.schema.Field');

      // OPTIONAL UINT32 id = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "id";
      $f->type      = \DrSlump\Protobuf::TYPE_UINT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING name = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "name";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING description = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "description";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL ENUM type = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "type";
      $f->type      = \DrSlump\Protobuf::TYPE_ENUM;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\sajari\engine\schema\Field\Type';
      $descriptor->addField($f);

      // OPTIONAL BOOL repeated = 5
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 5;
      $f->name      = "repeated";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL BOOL required = 6
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 6;
      $f->name      = "required";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL BOOL store = 7
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 7;
      $f->name      = "store";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL BOOL indexed = 8
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 8;
      $f->name      = "indexed";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL BOOL unique = 9
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 9;
      $f->name      = "unique";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <id> has a value
     *
     * @return boolean
     */
    public function hasId(){
      return $this->_has(1);
    }
    
    /**
     * Clear <id> value
     *
     * @return \sajari\engine\schema\Field
     */
    public function clearId(){
      return $this->_clear(1);
    }
    
    /**
     * Get <id> value
     *
     * @return int
     */
    public function getId(){
      return $this->_get(1);
    }
    
    /**
     * Set <id> value
     *
     * @param int $value
     * @return \sajari\engine\schema\Field
     */
    public function setId( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <name> has a value
     *
     * @return boolean
     */
    public function hasName(){
      return $this->_has(2);
    }
    
    /**
     * Clear <name> value
     *
     * @return \sajari\engine\schema\Field
     */
    public function clearName(){
      return $this->_clear(2);
    }
    
    /**
     * Get <name> value
     *
     * @return string
     */
    public function getName(){
      return $this->_get(2);
    }
    
    /**
     * Set <name> value
     *
     * @param string $value
     * @return \sajari\engine\schema\Field
     */
    public function setName( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <description> has a value
     *
     * @return boolean
     */
    public function hasDescription(){
      return $this->_has(3);
    }
    
    /**
     * Clear <description> value
     *
     * @return \sajari\engine\schema\Field
     */
    public function clearDescription(){
      return $this->_clear(3);
    }
    
    /**
     * Get <description> value
     *
     * @return string
     */
    public function getDescription(){
      return $this->_get(3);
    }
    
    /**
     * Set <description> value
     *
     * @param string $value
     * @return \sajari\engine\schema\Field
     */
    public function setDescription( $value){
      return $this->_set(3, $value);
    }
    
    /**
     * Check if <type> has a value
     *
     * @return boolean
     */
    public function hasType(){
      return $this->_has(4);
    }
    
    /**
     * Clear <type> value
     *
     * @return \sajari\engine\schema\Field
     */
    public function clearType(){
      return $this->_clear(4);
    }
    
    /**
     * Get <type> value
     *
     * @return int - \sajari\engine\schema\Field\Type
     */
    public function getType(){
      return $this->_get(4);
    }
    
    /**
     * Set <type> value
     *
     * @param int - \sajari\engine\schema\Field\Type $value
     * @return \sajari\engine\schema\Field
     */
    public function setType( $value){
      return $this->_set(4, $value);
    }
    
    /**
     * Check if <repeated> has a value
     *
     * @return boolean
     */
    public function hasRepeated(){
      return $this->_has(5);
    }
    
    /**
     * Clear <repeated> value
     *
     * @return \sajari\engine\schema\Field
     */
    public function clearRepeated(){
      return $this->_clear(5);
    }
    
    /**
     * Get <repeated> value
     *
     * @return boolean
     */
    public function getRepeated(){
      return $this->_get(5);
    }
    
    /**
     * Set <repeated> value
     *
     * @param boolean $value
     * @return \sajari\engine\schema\Field
     */
    public function setRepeated( $value){
      return $this->_set(5, $value);
    }
    
    /**
     * Check if <required> has a value
     *
     * @return boolean
     */
    public function hasRequired(){
      return $this->_has(6);
    }
    
    /**
     * Clear <required> value
     *
     * @return \sajari\engine\schema\Field
     */
    public function clearRequired(){
      return $this->_clear(6);
    }
    
    /**
     * Get <required> value
     *
     * @return boolean
     */
    public function getRequired(){
      return $this->_get(6);
    }
    
    /**
     * Set <required> value
     *
     * @param boolean $value
     * @return \sajari\engine\schema\Field
     */
    public function setRequired( $value){
      return $this->_set(6, $value);
    }
    
    /**
     * Check if <store> has a value
     *
     * @return boolean
     */
    public function hasStore(){
      return $this->_has(7);
    }
    
    /**
     * Clear <store> value
     *
     * @return \sajari\engine\schema\Field
     */
    public function clearStore(){
      return $this->_clear(7);
    }
    
    /**
     * Get <store> value
     *
     * @return boolean
     */
    public function getStore(){
      return $this->_get(7);
    }
    
    /**
     * Set <store> value
     *
     * @param boolean $value
     * @return \sajari\engine\schema\Field
     */
    public function setStore( $value){
      return $this->_set(7, $value);
    }
    
    /**
     * Check if <indexed> has a value
     *
     * @return boolean
     */
    public function hasIndexed(){
      return $this->_has(8);
    }
    
    /**
     * Clear <indexed> value
     *
     * @return \sajari\engine\schema\Field
     */
    public function clearIndexed(){
      return $this->_clear(8);
    }
    
    /**
     * Get <indexed> value
     *
     * @return boolean
     */
    public function getIndexed(){
      return $this->_get(8);
    }
    
    /**
     * Set <indexed> value
     *
     * @param boolean $value
     * @return \sajari\engine\schema\Field
     */
    public function setIndexed( $value){
      return $this->_set(8, $value);
    }
    
    /**
     * Check if <unique> has a value
     *
     * @return boolean
     */
    public function hasUnique(){
      return $this->_has(9);
    }
    
    /**
     * Clear <unique> value
     *
     * @return \sajari\engine\schema\Field
     */
    public function clearUnique(){
      return $this->_clear(9);
    }
    
    /**
     * Get <unique> value
     *
     * @return boolean
     */
    public function getUnique(){
      return $this->_get(9);
    }
    
    /**
     * Set <unique> value
     *
     * @param boolean $value
     * @return \sajari\engine\schema\Field
     */
    public function setUnique( $value){
      return $this->_set(9, $value);
    }
  }
}

namespace sajari\engine\schema {

  class Response extends \DrSlump\Protobuf\Message {

    /**  @var \sajari\engine\Status[]  */
    public $status = array();
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.engine.schema.Response');

      // REPEATED MESSAGE status = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "status";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\sajari\engine\Status';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <status> has a value
     *
     * @return boolean
     */
    public function hasStatus(){
      return $this->_has(1);
    }
    
    /**
     * Clear <status> value
     *
     * @return \sajari\engine\schema\Response
     */
    public function clearStatus(){
      return $this->_clear(1);
    }
    
    /**
     * Get <status> value
     *
     * @param int $idx
     * @return \sajari\engine\Status
     */
    public function getStatus($idx = NULL){
      return $this->_get(1, $idx);
    }
    
    /**
     * Set <status> value
     *
     * @param \sajari\engine\Status $value
     * @return \sajari\engine\schema\Response
     */
    public function setStatus(\sajari\engine\Status $value, $idx = NULL){
      return $this->_set(1, $value, $idx);
    }
    
    /**
     * Get all elements of <status>
     *
     * @return \sajari\engine\Status[]
     */
    public function getStatusList(){
     return $this->_get(1);
    }
    
    /**
     * Add a new element to <status>
     *
     * @param \sajari\engine\Status $value
     * @return \sajari\engine\schema\Response
     */
    public function addStatus(\sajari\engine\Status $value){
     return $this->_add(1, $value);
    }
  }
}

namespace sajari\engine\schema\MutateFieldRequest {

  class Mutation extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $name = null;
    
    /**  @var string */
    public $description = null;
    
    /**  @var int - \sajari\engine\schema\Field\Type */
    public $type = null;
    
    /**  @var boolean */
    public $repeated = null;
    
    /**  @var boolean */
    public $required = null;
    
    /**  @var boolean */
    public $unique = null;
    
    /**  @var boolean */
    public $indexed = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.engine.schema.MutateFieldRequest.Mutation');

      // OPTIONAL STRING name = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "name";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING description = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "description";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL ENUM type = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "type";
      $f->type      = \DrSlump\Protobuf::TYPE_ENUM;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\sajari\engine\schema\Field\Type';
      $descriptor->addField($f);

      // OPTIONAL BOOL repeated = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "repeated";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL BOOL required = 5
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 5;
      $f->name      = "required";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL BOOL unique = 6
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 6;
      $f->name      = "unique";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL BOOL indexed = 7
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 7;
      $f->name      = "indexed";
      $f->type      = \DrSlump\Protobuf::TYPE_BOOL;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <name> has a value
     *
     * @return boolean
     */
    public function hasName(){
      return $this->_has(1);
    }
    
    /**
     * Clear <name> value
     *
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function clearName(){
      return $this->_clear(1);
    }
    
    /**
     * Get <name> value
     *
     * @return string
     */
    public function getName(){
      return $this->_get(1);
    }
    
    /**
     * Set <name> value
     *
     * @param string $value
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function setName( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <description> has a value
     *
     * @return boolean
     */
    public function hasDescription(){
      return $this->_has(2);
    }
    
    /**
     * Clear <description> value
     *
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function clearDescription(){
      return $this->_clear(2);
    }
    
    /**
     * Get <description> value
     *
     * @return string
     */
    public function getDescription(){
      return $this->_get(2);
    }
    
    /**
     * Set <description> value
     *
     * @param string $value
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function setDescription( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <type> has a value
     *
     * @return boolean
     */
    public function hasType(){
      return $this->_has(3);
    }
    
    /**
     * Clear <type> value
     *
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function clearType(){
      return $this->_clear(3);
    }
    
    /**
     * Get <type> value
     *
     * @return int - \sajari\engine\schema\Field\Type
     */
    public function getType(){
      return $this->_get(3);
    }
    
    /**
     * Set <type> value
     *
     * @param int - \sajari\engine\schema\Field\Type $value
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function setType( $value){
      return $this->_set(3, $value);
    }
    
    /**
     * Check if <repeated> has a value
     *
     * @return boolean
     */
    public function hasRepeated(){
      return $this->_has(4);
    }
    
    /**
     * Clear <repeated> value
     *
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function clearRepeated(){
      return $this->_clear(4);
    }
    
    /**
     * Get <repeated> value
     *
     * @return boolean
     */
    public function getRepeated(){
      return $this->_get(4);
    }
    
    /**
     * Set <repeated> value
     *
     * @param boolean $value
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function setRepeated( $value){
      return $this->_set(4, $value);
    }
    
    /**
     * Check if <required> has a value
     *
     * @return boolean
     */
    public function hasRequired(){
      return $this->_has(5);
    }
    
    /**
     * Clear <required> value
     *
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function clearRequired(){
      return $this->_clear(5);
    }
    
    /**
     * Get <required> value
     *
     * @return boolean
     */
    public function getRequired(){
      return $this->_get(5);
    }
    
    /**
     * Set <required> value
     *
     * @param boolean $value
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function setRequired( $value){
      return $this->_set(5, $value);
    }
    
    /**
     * Check if <unique> has a value
     *
     * @return boolean
     */
    public function hasUnique(){
      return $this->_has(6);
    }
    
    /**
     * Clear <unique> value
     *
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function clearUnique(){
      return $this->_clear(6);
    }
    
    /**
     * Get <unique> value
     *
     * @return boolean
     */
    public function getUnique(){
      return $this->_get(6);
    }
    
    /**
     * Set <unique> value
     *
     * @param boolean $value
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function setUnique( $value){
      return $this->_set(6, $value);
    }
    
    /**
     * Check if <indexed> has a value
     *
     * @return boolean
     */
    public function hasIndexed(){
      return $this->_has(7);
    }
    
    /**
     * Clear <indexed> value
     *
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function clearIndexed(){
      return $this->_clear(7);
    }
    
    /**
     * Get <indexed> value
     *
     * @return boolean
     */
    public function getIndexed(){
      return $this->_get(7);
    }
    
    /**
     * Set <indexed> value
     *
     * @param boolean $value
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function setIndexed( $value){
      return $this->_set(7, $value);
    }
  }
}

namespace sajari\engine\schema {

  class MutateFieldRequest extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $name = null;
    
    /**  @var \sajari\engine\schema\MutateFieldRequest\Mutation[]  */
    public $mutations = array();
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.engine.schema.MutateFieldRequest');

      // OPTIONAL STRING name = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "name";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // REPEATED MESSAGE mutations = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "mutations";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\sajari\engine\schema\MutateFieldRequest\Mutation';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <name> has a value
     *
     * @return boolean
     */
    public function hasName(){
      return $this->_has(1);
    }
    
    /**
     * Clear <name> value
     *
     * @return \sajari\engine\schema\MutateFieldRequest
     */
    public function clearName(){
      return $this->_clear(1);
    }
    
    /**
     * Get <name> value
     *
     * @return string
     */
    public function getName(){
      return $this->_get(1);
    }
    
    /**
     * Set <name> value
     *
     * @param string $value
     * @return \sajari\engine\schema\MutateFieldRequest
     */
    public function setName( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <mutations> has a value
     *
     * @return boolean
     */
    public function hasMutations(){
      return $this->_has(2);
    }
    
    /**
     * Clear <mutations> value
     *
     * @return \sajari\engine\schema\MutateFieldRequest
     */
    public function clearMutations(){
      return $this->_clear(2);
    }
    
    /**
     * Get <mutations> value
     *
     * @param int $idx
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation
     */
    public function getMutations($idx = NULL){
      return $this->_get(2, $idx);
    }
    
    /**
     * Set <mutations> value
     *
     * @param \sajari\engine\schema\MutateFieldRequest\Mutation $value
     * @return \sajari\engine\schema\MutateFieldRequest
     */
    public function setMutations(\sajari\engine\schema\MutateFieldRequest\Mutation $value, $idx = NULL){
      return $this->_set(2, $value, $idx);
    }
    
    /**
     * Get all elements of <mutations>
     *
     * @return \sajari\engine\schema\MutateFieldRequest\Mutation[]
     */
    public function getMutationsList(){
     return $this->_get(2);
    }
    
    /**
     * Add a new element to <mutations>
     *
     * @param \sajari\engine\schema\MutateFieldRequest\Mutation $value
     * @return \sajari\engine\schema\MutateFieldRequest
     */
    public function addMutations(\sajari\engine\schema\MutateFieldRequest\Mutation $value){
     return $this->_add(2, $value);
    }
  }
}

namespace sajari\engine\schema {

  class SchemaClient extends \Grpc\BaseStub {

    public function __construct($hostname, $opts, $channel = null) {
      parent::__construct($hostname, $opts, $channel);
    }
    /**
     * @param sajari\engine\Empty $input
     */
    public function GetFields(\sajari\engine\Empty $argument, $metadata = array(), $options = array()) {
      return $this->_simpleRequest('/sajari.engine.schema.Schema/GetFields', $argument, '\sajari\engine\schema\Fields::deserialize', $metadata, $options);
    }
    /**
     * @param sajari\engine\schema\Fields $input
     */
    public function AddFields(\sajari\engine\schema\Fields $argument, $metadata = array(), $options = array()) {
      return $this->_simpleRequest('/sajari.engine.schema.Schema/AddFields', $argument, '\sajari\engine\schema\Response::deserialize', $metadata, $options);
    }
    /**
     * @param sajari\engine\schema\MutateFieldRequest $input
     */
    public function MutateField(\sajari\engine\schema\MutateFieldRequest $argument, $metadata = array(), $options = array()) {
      return $this->_simpleRequest('/sajari.engine.schema.Schema/MutateField', $argument, '\sajari\engine\schema\Response::deserialize', $metadata, $options);
    }
  }
}
