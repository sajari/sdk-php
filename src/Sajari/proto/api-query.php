<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 1.0
// Source: api/query/api-query.proto
//   Date: 2016-09-22 02:37:58

namespace sajari\api\query\SearchRequest\Tracking {

  class Type extends \DrSlump\Protobuf\Enum {
    const NONE = 0;
    const CLICK = 1;
    const POS_NEG = 2;
  }
}
namespace sajari\api\query\SearchRequest\Tracking {

  class DataEntry extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $key = null;

    /**  @var string */
    public $value = null;


    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.api.query.SearchRequest.Tracking.DataEntry');

      // OPTIONAL STRING key = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "key";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING value = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "value";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <key> has a value
     *
     * @return boolean
     */
    public function hasKey(){
      return $this->_has(1);
    }

    /**
     * Clear <key> value
     *
     * @return \sajari\api\query\SearchRequest\Tracking\DataEntry
     */
    public function clearKey(){
      return $this->_clear(1);
    }

    /**
     * Get <key> value
     *
     * @return string
     */
    public function getKey(){
      return $this->_get(1);
    }

    /**
     * Set <key> value
     *
     * @param string $value
     * @return \sajari\api\query\SearchRequest\Tracking\DataEntry
     */
    public function setKey( $value){
      return $this->_set(1, $value);
    }

    /**
     * Check if <value> has a value
     *
     * @return boolean
     */
    public function hasValue(){
      return $this->_has(2);
    }

    /**
     * Clear <value> value
     *
     * @return \sajari\api\query\SearchRequest\Tracking\DataEntry
     */
    public function clearValue(){
      return $this->_clear(2);
    }

    /**
     * Get <value> value
     *
     * @return string
     */
    public function getValue(){
      return $this->_get(2);
    }

    /**
     * Set <value> value
     *
     * @param string $value
     * @return \sajari\api\query\SearchRequest\Tracking\DataEntry
     */
    public function setValue( $value){
      return $this->_set(2, $value);
    }
  }
}

namespace sajari\api\query\SearchRequest {

  class Tracking extends \DrSlump\Protobuf\Message {

    /**  @var int - \sajari\api\query\SearchRequest\Tracking\Type */
    public $type = null;

    /**  @var string */
    public $query_id = null;

    /**  @var int */
    public $sequence = null;

    /**  @var string */
    public $field = null;

    /**  @var \sajari\api\query\SearchRequest\Tracking\DataEntry[]  */
    public $data = array();


    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.api.query.SearchRequest.Tracking');

      // OPTIONAL ENUM type = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "type";
      $f->type      = \DrSlump\Protobuf::TYPE_ENUM;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\sajari\api\query\SearchRequest\Tracking\Type';
      $descriptor->addField($f);

      // OPTIONAL STRING query_id = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "query_id";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL INT32 sequence = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "sequence";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING field = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "field";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // REPEATED MESSAGE data = 5
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 5;
      $f->name      = "data";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\sajari\api\query\SearchRequest\Tracking\DataEntry';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <type> has a value
     *
     * @return boolean
     */
    public function hasType(){
      return $this->_has(1);
    }

    /**
     * Clear <type> value
     *
     * @return \sajari\api\query\SearchRequest\Tracking
     */
    public function clearType(){
      return $this->_clear(1);
    }

    /**
     * Get <type> value
     *
     * @return int - \sajari\api\query\SearchRequest\Tracking\Type
     */
    public function getType(){
      return $this->_get(1);
    }

    /**
     * Set <type> value
     *
     * @param int - \sajari\api\query\SearchRequest\Tracking\Type $value
     * @return \sajari\api\query\SearchRequest\Tracking
     */
    public function setType( $value){
      return $this->_set(1, $value);
    }

    /**
     * Check if <query_id> has a value
     *
     * @return boolean
     */
    public function hasQueryId(){
      return $this->_has(2);
    }

    /**
     * Clear <query_id> value
     *
     * @return \sajari\api\query\SearchRequest\Tracking
     */
    public function clearQueryId(){
      return $this->_clear(2);
    }

    /**
     * Get <query_id> value
     *
     * @return string
     */
    public function getQueryId(){
      return $this->_get(2);
    }

    /**
     * Set <query_id> value
     *
     * @param string $value
     * @return \sajari\api\query\SearchRequest\Tracking
     */
    public function setQueryId( $value){
      return $this->_set(2, $value);
    }

    /**
     * Check if <sequence> has a value
     *
     * @return boolean
     */
    public function hasSequence(){
      return $this->_has(3);
    }

    /**
     * Clear <sequence> value
     *
     * @return \sajari\api\query\SearchRequest\Tracking
     */
    public function clearSequence(){
      return $this->_clear(3);
    }

    /**
     * Get <sequence> value
     *
     * @return int
     */
    public function getSequence(){
      return $this->_get(3);
    }

    /**
     * Set <sequence> value
     *
     * @param int $value
     * @return \sajari\api\query\SearchRequest\Tracking
     */
    public function setSequence( $value){
      return $this->_set(3, $value);
    }

    /**
     * Check if <field> has a value
     *
     * @return boolean
     */
    public function hasField(){
      return $this->_has(4);
    }

    /**
     * Clear <field> value
     *
     * @return \sajari\api\query\SearchRequest\Tracking
     */
    public function clearField(){
      return $this->_clear(4);
    }

    /**
     * Get <field> value
     *
     * @return string
     */
    public function getField(){
      return $this->_get(4);
    }

    /**
     * Set <field> value
     *
     * @param string $value
     * @return \sajari\api\query\SearchRequest\Tracking
     */
    public function setField( $value){
      return $this->_set(4, $value);
    }

    /**
     * Check if <data> has a value
     *
     * @return boolean
     */
    public function hasData(){
      return $this->_has(5);
    }

    /**
     * Clear <data> value
     *
     * @return \sajari\api\query\SearchRequest\Tracking
     */
    public function clearData(){
      return $this->_clear(5);
    }

    /**
     * Get <data> value
     *
     * @param int $idx
     * @return \sajari\api\query\SearchRequest\Tracking\DataEntry
     */
    public function getData($idx = NULL){
      return $this->_get(5, $idx);
    }

    /**
     * Set <data> value
     *
     * @param \sajari\api\query\SearchRequest\Tracking\DataEntry $value
     * @return \sajari\api\query\SearchRequest\Tracking
     */
    public function setData(\sajari\api\query\SearchRequest\Tracking\DataEntry $value, $idx = NULL){
      return $this->_set(5, $value, $idx);
    }

    /**
     * Get all elements of <data>
     *
     * @return \sajari\api\query\SearchRequest\Tracking\DataEntry[]
     */
    public function getDataList(){
     return $this->_get(5);
    }

    /**
     * Add a new element to <data>
     *
     * @param \sajari\api\query\SearchRequest\Tracking\DataEntry $value
     * @return \sajari\api\query\SearchRequest\Tracking
     */
    public function addData(\sajari\api\query\SearchRequest\Tracking\DataEntry $value){
     return $this->_add(5, $value);
    }
  }
}

namespace sajari\api\query {

  class SearchRequest extends \DrSlump\Protobuf\Message {

    /**  @var \sajari\engine\query\SearchRequest */
    public $search_request = null;

    /**  @var \sajari\api\query\SearchRequest\Tracking */
    public $tracking = null;

    /**  @var \sajari\api\query\Transform[]  */
    public $transforms = array();


    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.api.query.SearchRequest');

      // OPTIONAL MESSAGE search_request = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "search_request";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\sajari\engine\query\SearchRequest';
      $descriptor->addField($f);

      // OPTIONAL MESSAGE tracking = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "tracking";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\sajari\api\query\SearchRequest\Tracking';
      $descriptor->addField($f);

      // REPEATED MESSAGE transforms = 5
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 5;
      $f->name      = "transforms";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\sajari\api\query\Transform';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <search_request> has a value
     *
     * @return boolean
     */
    public function hasSearchRequest(){
      return $this->_has(1);
    }

    /**
     * Clear <search_request> value
     *
     * @return \sajari\api\query\SearchRequest
     */
    public function clearSearchRequest(){
      return $this->_clear(1);
    }

    /**
     * Get <search_request> value
     *
     * @return \sajari\engine\query\SearchRequest
     */
    public function getSearchRequest(){
      return $this->_get(1);
    }

    /**
     * Set <search_request> value
     *
     * @param \sajari\engine\query\SearchRequest $value
     * @return \sajari\api\query\SearchRequest
     */
    public function setSearchRequest(\sajari\engine\query\SearchRequest $value){
      return $this->_set(1, $value);
    }

    /**
     * Check if <tracking> has a value
     *
     * @return boolean
     */
    public function hasTracking(){
      return $this->_has(4);
    }

    /**
     * Clear <tracking> value
     *
     * @return \sajari\api\query\SearchRequest
     */
    public function clearTracking(){
      return $this->_clear(4);
    }

    /**
     * Get <tracking> value
     *
     * @return \sajari\api\query\SearchRequest\Tracking
     */
    public function getTracking(){
      return $this->_get(4);
    }

    /**
     * Set <tracking> value
     *
     * @param \sajari\api\query\SearchRequest\Tracking $value
     * @return \sajari\api\query\SearchRequest
     */
    public function setTracking(\sajari\api\query\SearchRequest\Tracking $value){
      return $this->_set(4, $value);
    }

    /**
     * Check if <transforms> has a value
     *
     * @return boolean
     */
    public function hasTransforms(){
      return $this->_has(5);
    }

    /**
     * Clear <transforms> value
     *
     * @return \sajari\api\query\SearchRequest
     */
    public function clearTransforms(){
      return $this->_clear(5);
    }

    /**
     * Get <transforms> value
     *
     * @param int $idx
     * @return \sajari\api\query\Transform
     */
    public function getTransforms($idx = NULL){
      return $this->_get(5, $idx);
    }

    /**
     * Set <transforms> value
     *
     * @param \sajari\api\query\Transform $value
     * @return \sajari\api\query\SearchRequest
     */
    public function setTransforms(\sajari\api\query\Transform $value, $idx = NULL){
      return $this->_set(5, $value, $idx);
    }

    /**
     * Get all elements of <transforms>
     *
     * @return \sajari\api\query\Transform[]
     */
    public function getTransformsList(){
     return $this->_get(5);
    }

    /**
     * Add a new element to <transforms>
     *
     * @param \sajari\api\query\Transform $value
     * @return \sajari\api\query\SearchRequest
     */
    public function addTransforms(\sajari\api\query\Transform $value){
     return $this->_add(5, $value);
    }
  }
}

namespace sajari\api\query {

  class SearchResponse extends \DrSlump\Protobuf\Message {

    /**  @var \sajari\engine\query\SearchResponse */
    public $search_response = null;

    /**  @var \sajari\engine\query\SearchRequest */
    public $search_request = null;

    /**  @var \sajari\api\query\Token[]  */
    public $tokens = array();


    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.api.query.SearchResponse');

      // OPTIONAL MESSAGE search_response = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "search_response";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\sajari\engine\query\SearchResponse';
      $descriptor->addField($f);

      // OPTIONAL MESSAGE search_request = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "search_request";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\sajari\engine\query\SearchRequest';
      $descriptor->addField($f);

      // REPEATED MESSAGE tokens = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "tokens";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\sajari\api\query\Token';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <search_response> has a value
     *
     * @return boolean
     */
    public function hasSearchResponse(){
      return $this->_has(1);
    }

    /**
     * Clear <search_response> value
     *
     * @return \sajari\api\query\SearchResponse
     */
    public function clearSearchResponse(){
      return $this->_clear(1);
    }

    /**
     * Get <search_response> value
     *
     * @return \sajari\engine\query\SearchResponse
     */
    public function getSearchResponse(){
      return $this->_get(1);
    }

    /**
     * Set <search_response> value
     *
     * @param \sajari\engine\query\SearchResponse $value
     * @return \sajari\api\query\SearchResponse
     */
    public function setSearchResponse(\sajari\engine\query\SearchResponse $value){
      return $this->_set(1, $value);
    }

    /**
     * Check if <search_request> has a value
     *
     * @return boolean
     */
    public function hasSearchRequest(){
      return $this->_has(2);
    }

    /**
     * Clear <search_request> value
     *
     * @return \sajari\api\query\SearchResponse
     */
    public function clearSearchRequest(){
      return $this->_clear(2);
    }

    /**
     * Get <search_request> value
     *
     * @return \sajari\engine\query\SearchRequest
     */
    public function getSearchRequest(){
      return $this->_get(2);
    }

    /**
     * Set <search_request> value
     *
     * @param \sajari\engine\query\SearchRequest $value
     * @return \sajari\api\query\SearchResponse
     */
    public function setSearchRequest(\sajari\engine\query\SearchRequest $value){
      return $this->_set(2, $value);
    }

    /**
     * Check if <tokens> has a value
     *
     * @return boolean
     */
    public function hasTokens(){
      return $this->_has(3);
    }

    /**
     * Clear <tokens> value
     *
     * @return \sajari\api\query\SearchResponse
     */
    public function clearTokens(){
      return $this->_clear(3);
    }

    /**
     * Get <tokens> value
     *
     * @param int $idx
     * @return \sajari\api\query\Token
     */
    public function getTokens($idx = NULL){
      return $this->_get(3, $idx);
    }

    /**
     * Set <tokens> value
     *
     * @param \sajari\api\query\Token $value
     * @return \sajari\api\query\SearchResponse
     */
    public function setTokens(\sajari\api\query\Token $value, $idx = NULL){
      return $this->_set(3, $value, $idx);
    }

    /**
     * Get all elements of <tokens>
     *
     * @return \sajari\api\query\Token[]
     */
    public function getTokensList(){
     return $this->_get(3);
    }

    /**
     * Add a new element to <tokens>
     *
     * @param \sajari\api\query\Token $value
     * @return \sajari\api\query\SearchResponse
     */
    public function addTokens(\sajari\api\query\Token $value){
     return $this->_add(3, $value);
    }
  }
}

namespace sajari\api\query\Token {

  class Click extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $click = null;


    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.api.query.Token.Click');

      // OPTIONAL STRING click = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "click";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <click> has a value
     *
     * @return boolean
     */
    public function hasClick(){
      return $this->_has(1);
    }

    /**
     * Clear <click> value
     *
     * @return \sajari\api\query\Token\Click
     */
    public function clearClick(){
      return $this->_clear(1);
    }

    /**
     * Get <click> value
     *
     * @return string
     */
    public function getClick(){
      return $this->_get(1);
    }

    /**
     * Set <click> value
     *
     * @param string $value
     * @return \sajari\api\query\Token\Click
     */
    public function setClick( $value){
      return $this->_set(1, $value);
    }
  }
}

namespace sajari\api\query\Token {

  class PosNeg extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $pos = null;

    /**  @var string */
    public $neg = null;


    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.api.query.Token.PosNeg');

      // OPTIONAL STRING pos = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "pos";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING neg = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "neg";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <pos> has a value
     *
     * @return boolean
     */
    public function hasPos(){
      return $this->_has(1);
    }

    /**
     * Clear <pos> value
     *
     * @return \sajari\api\query\Token\PosNeg
     */
    public function clearPos(){
      return $this->_clear(1);
    }

    /**
     * Get <pos> value
     *
     * @return string
     */
    public function getPos(){
      return $this->_get(1);
    }

    /**
     * Set <pos> value
     *
     * @param string $value
     * @return \sajari\api\query\Token\PosNeg
     */
    public function setPos( $value){
      return $this->_set(1, $value);
    }

    /**
     * Check if <neg> has a value
     *
     * @return boolean
     */
    public function hasNeg(){
      return $this->_has(2);
    }

    /**
     * Clear <neg> value
     *
     * @return \sajari\api\query\Token\PosNeg
     */
    public function clearNeg(){
      return $this->_clear(2);
    }

    /**
     * Get <neg> value
     *
     * @return string
     */
    public function getNeg(){
      return $this->_get(2);
    }

    /**
     * Set <neg> value
     *
     * @param string $value
     * @return \sajari\api\query\Token\PosNeg
     */
    public function setNeg( $value){
      return $this->_set(2, $value);
    }
  }
}

namespace sajari\api\query {

  class Token extends \DrSlump\Protobuf\Message {

    /**  @var \sajari\api\query\Token\Click */
    public $click = null;

    /**  @var \sajari\api\query\Token\PosNeg */
    public $pos_neg = null;


    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.api.query.Token');

      // OPTIONAL MESSAGE click = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "click";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\sajari\api\query\Token\Click';
      $descriptor->addField($f);

      // OPTIONAL MESSAGE pos_neg = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "pos_neg";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\sajari\api\query\Token\PosNeg';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <click> has a value
     *
     * @return boolean
     */
    public function hasClick(){
      return $this->_has(1);
    }

    /**
     * Clear <click> value
     *
     * @return \sajari\api\query\Token
     */
    public function clearClick(){
      return $this->_clear(1);
    }

    /**
     * Get <click> value
     *
     * @return \sajari\api\query\Token\Click
     */
    public function getClick(){
      return $this->_get(1);
    }

    /**
     * Set <click> value
     *
     * @param \sajari\api\query\Token\Click $value
     * @return \sajari\api\query\Token
     */
    public function setClick(\sajari\api\query\Token\Click $value){
      return $this->_set(1, $value);
    }

    /**
     * Check if <pos_neg> has a value
     *
     * @return boolean
     */
    public function hasPosNeg(){
      return $this->_has(2);
    }

    /**
     * Clear <pos_neg> value
     *
     * @return \sajari\api\query\Token
     */
    public function clearPosNeg(){
      return $this->_clear(2);
    }

    /**
     * Get <pos_neg> value
     *
     * @return \sajari\api\query\Token\PosNeg
     */
    public function getPosNeg(){
      return $this->_get(2);
    }

    /**
     * Set <pos_neg> value
     *
     * @param \sajari\api\query\Token\PosNeg $value
     * @return \sajari\api\query\Token
     */
    public function setPosNeg(\sajari\api\query\Token\PosNeg $value){
      return $this->_set(2, $value);
    }
  }
}

namespace sajari\api\query\Transform {

  class RunType extends \DrSlump\Protobuf\Enum {
    const PRE_QUERY = 0;
    const POST_NON_EMPTY = 1;
    const POST_EMPTY_PRE_RETRY = 3;
  }
}
namespace sajari\api\query {

  class Transform extends \DrSlump\Protobuf\Message {

    /**  @var int - \sajari\api\query\Transform\RunType */
    public $run_type = null;

    /**  @var string */
    public $identifier = null;


    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'sajari.api.query.Transform');

      // OPTIONAL ENUM run_type = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "run_type";
      $f->type      = \DrSlump\Protobuf::TYPE_ENUM;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\sajari\api\query\Transform\RunType';
      $descriptor->addField($f);

      // OPTIONAL STRING identifier = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "identifier";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <run_type> has a value
     *
     * @return boolean
     */
    public function hasRunType(){
      return $this->_has(1);
    }

    /**
     * Clear <run_type> value
     *
     * @return \sajari\api\query\Transform
     */
    public function clearRunType(){
      return $this->_clear(1);
    }

    /**
     * Get <run_type> value
     *
     * @return int - \sajari\api\query\Transform\RunType
     */
    public function getRunType(){
      return $this->_get(1);
    }

    /**
     * Set <run_type> value
     *
     * @param int - \sajari\api\query\Transform\RunType $value
     * @return \sajari\api\query\Transform
     */
    public function setRunType( $value){
      return $this->_set(1, $value);
    }

    /**
     * Check if <identifier> has a value
     *
     * @return boolean
     */
    public function hasIdentifier(){
      return $this->_has(2);
    }

    /**
     * Clear <identifier> value
     *
     * @return \sajari\api\query\Transform
     */
    public function clearIdentifier(){
      return $this->_clear(2);
    }

    /**
     * Get <identifier> value
     *
     * @return string
     */
    public function getIdentifier(){
      return $this->_get(2);
    }

    /**
     * Set <identifier> value
     *
     * @param string $value
     * @return \sajari\api\query\Transform
     */
    public function setIdentifier( $value){
      return $this->_set(2, $value);
    }
  }
}

namespace sajari\api\query {

  class QueryClient extends \Grpc\BaseStub {

    public function __construct($hostname, $opts) {
      parent::__construct($hostname, $opts);
    }
    /**
     * @param sajari\api\query\SearchRequest $input
     */
    public function Search(\sajari\api\query\SearchRequest $argument, $metadata = array(), $options = array()) {
      return $this->_simpleRequest('/sajari.api.query.Query/Search', $argument, '\sajari\api\query\SearchResponse::deserialize', $metadata, $options);
    }
  }
}
