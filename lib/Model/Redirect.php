<?php
/**
 * Redirect
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
 * Redirect Class Doc Comment
 *
 * @category Class
 * @description Redirect contains a target that you can redirect users to if their search query matches a certain condition.
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Redirect implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = "Redirect";

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        "collection_id" => "string",
        "condition" => "string",
        "create_time" => "\DateTime",
        "disabled" => "bool",
        "id" => "string",
        "target" => "string",
        "update_time" => "\DateTime",
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        "collection_id" => null,
        "condition" => null,
        "create_time" => "date-time",
        "disabled" => null,
        "id" => null,
        "target" => null,
        "update_time" => "date-time",
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
        "collection_id" => "collection_id",
        "condition" => "condition",
        "create_time" => "create_time",
        "disabled" => "disabled",
        "id" => "id",
        "target" => "target",
        "update_time" => "update_time",
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        "collection_id" => "setCollectionId",
        "condition" => "setCondition",
        "create_time" => "setCreateTime",
        "disabled" => "setDisabled",
        "id" => "setId",
        "target" => "setTarget",
        "update_time" => "setUpdateTime",
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        "collection_id" => "getCollectionId",
        "condition" => "getCondition",
        "create_time" => "getCreateTime",
        "disabled" => "getDisabled",
        "id" => "getId",
        "target" => "getTarget",
        "update_time" => "getUpdateTime",
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
        $this->container["collection_id"] = $data["collection_id"] ?? null;
        $this->container["condition"] = $data["condition"] ?? null;
        $this->container["create_time"] = $data["create_time"] ?? null;
        $this->container["disabled"] = $data["disabled"] ?? null;
        $this->container["id"] = $data["id"] ?? null;
        $this->container["target"] = $data["target"] ?? null;
        $this->container["update_time"] = $data["update_time"] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container["condition"] === null) {
            $invalidProperties[] = "'condition' can't be null";
        }
        if ($this->container["target"] === null) {
            $invalidProperties[] = "'target' can't be null";
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
     * Gets collection_id
     *
     * @return string|null
     */
    public function getCollectionId()
    {
        return $this->container["collection_id"];
    }

    /**
     * Sets collection_id
     *
     * @param string|null $collection_id Output only. The ID of the collection that owns this redirect.
     *
     * @return self
     */
    public function setCollectionId($collection_id)
    {
        $this->container["collection_id"] = $collection_id;

        return $this;
    }

    /**
     * Gets condition
     *
     * @return string
     */
    public function getCondition()
    {
        return $this->container["condition"];
    }

    /**
     * Sets condition
     *
     * @param string $condition A condition expression applied to a search request that determines whether a search is redirected.  For example, to redirect if the user's query is `apples`, set condition to `q = 'apples'`.
     *
     * @return self
     */
    public function setCondition($condition)
    {
        $this->container["condition"] = $condition;

        return $this;
    }

    /**
     * Gets create_time
     *
     * @return \DateTime|null
     */
    public function getCreateTime()
    {
        return $this->container["create_time"];
    }

    /**
     * Sets create_time
     *
     * @param \DateTime|null $create_time Output only. Time the redirect was created.
     *
     * @return self
     */
    public function setCreateTime($create_time)
    {
        $this->container["create_time"] = $create_time;

        return $this;
    }

    /**
     * Gets disabled
     *
     * @return bool|null
     */
    public function getDisabled()
    {
        return $this->container["disabled"];
    }

    /**
     * Sets disabled
     *
     * @param bool|null $disabled If disabled, the redirect is never triggered.
     *
     * @return self
     */
    public function setDisabled($disabled)
    {
        $this->container["disabled"] = $disabled;

        return $this;
    }

    /**
     * Gets id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->container["id"];
    }

    /**
     * Sets id
     *
     * @param string|null $id Output only. The redirect's ID.
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container["id"] = $id;

        return $this;
    }

    /**
     * Gets target
     *
     * @return string
     */
    public function getTarget()
    {
        return $this->container["target"];
    }

    /**
     * Sets target
     *
     * @param string $target The target to redirect the user to if their query matches `condition`.  For searches performed in a browser, target is usually a URL but it can be any value that your integration can interpret as a redirect.  For example, for URLs that you need to resolve at runtime, target might be a URL template string. For apps, target might be a unique identifier used to send the user to the correct view.
     *
     * @return self
     */
    public function setTarget($target)
    {
        $this->container["target"] = $target;

        return $this;
    }

    /**
     * Gets update_time
     *
     * @return \DateTime|null
     */
    public function getUpdateTime()
    {
        return $this->container["update_time"];
    }

    /**
     * Sets update_time
     *
     * @param \DateTime|null $update_time Output only. Time the redirect was last updated.
     *
     * @return self
     */
    public function setUpdateTime($update_time)
    {
        $this->container["update_time"] = $update_time;

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
