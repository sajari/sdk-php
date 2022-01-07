<?php
/**
 * QueryCollectionRequest
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
 * QueryCollectionRequest Class Doc Comment
 *
 * @category Class
 * @description A request to perform a search using a pipeline.
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class QueryCollectionRequest implements
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
    protected static $openAPIModelName = "QueryCollectionRequest";

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        "pipeline" => "\Sajari\Model\QueryCollectionRequestPipeline",
        "tracking" => "\Sajari\Model\QueryCollectionRequestTracking",
        "variables" => "map[string,object]",
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        "pipeline" => null,
        "tracking" => null,
        "variables" => null,
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
        "pipeline" => "pipeline",
        "tracking" => "tracking",
        "variables" => "variables",
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        "pipeline" => "setPipeline",
        "tracking" => "setTracking",
        "variables" => "setVariables",
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        "pipeline" => "getPipeline",
        "tracking" => "getTracking",
        "variables" => "getVariables",
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
        $this->container["pipeline"] = $data["pipeline"] ?? null;
        $this->container["tracking"] = $data["tracking"] ?? null;
        $this->container["variables"] = $data["variables"] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container["variables"] === null) {
            $invalidProperties[] = "'variables' can't be null";
        }
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
     * Gets pipeline
     *
     * @return \Sajari\Model\QueryCollectionRequestPipeline|null
     */
    public function getPipeline()
    {
        return $this->container["pipeline"];
    }

    /**
     * Sets pipeline
     *
     * @param \Sajari\Model\QueryCollectionRequestPipeline|null $pipeline pipeline
     *
     * @return self
     */
    public function setPipeline($pipeline)
    {
        $this->container["pipeline"] = $pipeline;

        return $this;
    }

    /**
     * Gets tracking
     *
     * @return \Sajari\Model\QueryCollectionRequestTracking|null
     */
    public function getTracking()
    {
        return $this->container["tracking"];
    }

    /**
     * Sets tracking
     *
     * @param \Sajari\Model\QueryCollectionRequestTracking|null $tracking tracking
     *
     * @return self
     */
    public function setTracking($tracking)
    {
        $this->container["tracking"] = $tracking;

        return $this;
    }

    /**
     * Gets variables
     *
     * @return map[string,object]
     */
    public function getVariables()
    {
        return $this->container["variables"];
    }

    /**
     * Sets variables
     *
     * @param map[string,object] $variables The initial values for the variables the pipeline operates on and transforms throughout its steps.  The most important variable is `q` which is the query the user entered, for example:  ```json { \"q\": \"search terms\" } ```  To paginate through results, set the variables `page` and `resultsPerPage`, for example:  ```json { \"q\": \"search terms\", \"page\": 5, \"resultsPerPage\": 20 } ```  To sort results, set the variable `sort` to the name of one of your collection's schema fields, for example:  ```json { \"q\": \"search terms\", \"sort\": \"name\" } ```  To sort in reverse, prefix the schema field with a minus sign `-`, for example:  ```json { \"q\": \"search terms\", \"sort\": \"-name\" } ```
     *
     * @return self
     */
    public function setVariables($variables)
    {
        $this->container["variables"] = $variables;

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
