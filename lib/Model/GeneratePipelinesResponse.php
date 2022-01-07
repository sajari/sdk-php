<?php
/**
 * GeneratePipelinesResponse
 *
 * PHP version 7.2
 *
 * @category Class
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Search.io API
 *
 * Search.io is a smart, highly-configurable, real-time search service that enables thousands of businesses worldwide to provide amazing search experiences on their websites, stores, and applications.
 *
 * The version of the OpenAPI document: v4
 * Contact: support@search.io
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.0.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Sajari\Model;

use \ArrayAccess;
use Sajari\ObjectSerializer;

/**
 * GeneratePipelinesResponse Class Doc Comment
 *
 * @category Class
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class GeneratePipelinesResponse implements
    ModelInterface,
    ArrayAccess,
    \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = "GeneratePipelinesResponse";

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        "autocomplete_pipeline" => "\Sajari\Model\Pipeline",
        "query_pipeline" => "\Sajari\Model\Pipeline",
        "record_pipeline" => "\Sajari\Model\Pipeline",
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        "autocomplete_pipeline" => null,
        "query_pipeline" => null,
        "record_pipeline" => null,
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        "autocomplete_pipeline" => "autocomplete_pipeline",
        "query_pipeline" => "query_pipeline",
        "record_pipeline" => "record_pipeline",
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        "autocomplete_pipeline" => "setAutocompletePipeline",
        "query_pipeline" => "setQueryPipeline",
        "record_pipeline" => "setRecordPipeline",
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        "autocomplete_pipeline" => "getAutocompletePipeline",
        "query_pipeline" => "getQueryPipeline",
        "record_pipeline" => "getRecordPipeline",
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container["autocomplete_pipeline"] =
            $data["autocomplete_pipeline"] ?? null;
        $this->container["query_pipeline"] = $data["query_pipeline"] ?? null;
        $this->container["record_pipeline"] = $data["record_pipeline"] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }

    /**
     * Gets autocomplete_pipeline
     *
     * @return \Sajari\Model\Pipeline|null
     */
    public function getAutocompletePipeline()
    {
        return $this->container["autocomplete_pipeline"];
    }

    /**
     * Sets autocomplete_pipeline
     *
     * @param \Sajari\Model\Pipeline|null $autocomplete_pipeline autocomplete_pipeline
     *
     * @return self
     */
    public function setAutocompletePipeline($autocomplete_pipeline)
    {
        $this->container["autocomplete_pipeline"] = $autocomplete_pipeline;

        return $this;
    }

    /**
     * Gets query_pipeline
     *
     * @return \Sajari\Model\Pipeline|null
     */
    public function getQueryPipeline()
    {
        return $this->container["query_pipeline"];
    }

    /**
     * Sets query_pipeline
     *
     * @param \Sajari\Model\Pipeline|null $query_pipeline query_pipeline
     *
     * @return self
     */
    public function setQueryPipeline($query_pipeline)
    {
        $this->container["query_pipeline"] = $query_pipeline;

        return $this;
    }

    /**
     * Gets record_pipeline
     *
     * @return \Sajari\Model\Pipeline|null
     */
    public function getRecordPipeline()
    {
        return $this->container["record_pipeline"];
    }

    /**
     * Sets record_pipeline
     *
     * @param \Sajari\Model\Pipeline|null $record_pipeline record_pipeline
     *
     * @return self
     */
    public function setRecordPipeline($record_pipeline)
    {
        $this->container["record_pipeline"] = $record_pipeline;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
