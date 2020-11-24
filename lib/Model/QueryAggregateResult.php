<?php
/**
 * QueryAggregateResult
 *
 * PHP version 7.2
 *
 * @category Class
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Sajari API
 *
 * Sajari is a smart, highly-configurable, real-time search service that enables thousands of businesses worldwide to provide amazing search experiences on their websites, stores, and applications.
 *
 * The version of the OpenAPI document: v4
 * Contact: support@sajari.com
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
 * QueryAggregateResult Class Doc Comment
 *
 * @category Class
 * @description A query aggregate result contains results of aggregations.
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class QueryAggregateResult implements
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
    protected static $openAPIModelName = "QueryAggregateResult";

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        "metric" => "\Sajari\Model\QueryAggregateResultMetric",
        "count" => "\Sajari\Model\QueryAggregateResultCount",
        "buckets" => "\Sajari\Model\QueryAggregateResultBuckets",
        "date" => "\Sajari\Model\QueryAggregateResultDate",
        "analysis" => "\Sajari\Model\QueryAggregateResultAnalysis",
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        "metric" => null,
        "count" => null,
        "buckets" => null,
        "date" => null,
        "analysis" => null,
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
        "metric" => "metric",
        "count" => "count",
        "buckets" => "buckets",
        "date" => "date",
        "analysis" => "analysis",
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        "metric" => "setMetric",
        "count" => "setCount",
        "buckets" => "setBuckets",
        "date" => "setDate",
        "analysis" => "setAnalysis",
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        "metric" => "getMetric",
        "count" => "getCount",
        "buckets" => "getBuckets",
        "date" => "getDate",
        "analysis" => "getAnalysis",
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
        $this->container["metric"] = $data["metric"] ?? null;
        $this->container["count"] = $data["count"] ?? null;
        $this->container["buckets"] = $data["buckets"] ?? null;
        $this->container["date"] = $data["date"] ?? null;
        $this->container["analysis"] = $data["analysis"] ?? null;
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
     * Gets metric
     *
     * @return \Sajari\Model\QueryAggregateResultMetric|null
     */
    public function getMetric()
    {
        return $this->container["metric"];
    }

    /**
     * Sets metric
     *
     * @param \Sajari\Model\QueryAggregateResultMetric|null $metric metric
     *
     * @return self
     */
    public function setMetric($metric)
    {
        $this->container["metric"] = $metric;

        return $this;
    }

    /**
     * Gets count
     *
     * @return \Sajari\Model\QueryAggregateResultCount|null
     */
    public function getCount()
    {
        return $this->container["count"];
    }

    /**
     * Sets count
     *
     * @param \Sajari\Model\QueryAggregateResultCount|null $count count
     *
     * @return self
     */
    public function setCount($count)
    {
        $this->container["count"] = $count;

        return $this;
    }

    /**
     * Gets buckets
     *
     * @return \Sajari\Model\QueryAggregateResultBuckets|null
     */
    public function getBuckets()
    {
        return $this->container["buckets"];
    }

    /**
     * Sets buckets
     *
     * @param \Sajari\Model\QueryAggregateResultBuckets|null $buckets buckets
     *
     * @return self
     */
    public function setBuckets($buckets)
    {
        $this->container["buckets"] = $buckets;

        return $this;
    }

    /**
     * Gets date
     *
     * @return \Sajari\Model\QueryAggregateResultDate|null
     */
    public function getDate()
    {
        return $this->container["date"];
    }

    /**
     * Sets date
     *
     * @param \Sajari\Model\QueryAggregateResultDate|null $date date
     *
     * @return self
     */
    public function setDate($date)
    {
        $this->container["date"] = $date;

        return $this;
    }

    /**
     * Gets analysis
     *
     * @return \Sajari\Model\QueryAggregateResultAnalysis|null
     */
    public function getAnalysis()
    {
        return $this->container["analysis"];
    }

    /**
     * Sets analysis
     *
     * @param \Sajari\Model\QueryAggregateResultAnalysis|null $analysis analysis
     *
     * @return self
     */
    public function setAnalysis($analysis)
    {
        $this->container["analysis"] = $analysis;

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