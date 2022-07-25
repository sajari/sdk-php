<?php
/**
 * Event
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
 * The version of the OpenAPI document: 4.0.0
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
 * Event Class Doc Comment
 *
 * @category Class
 * @description An analytics event that relates to a query made on a collection.
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Event implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = "Event";

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        "banner_id" => "string",
        "metadata" => "map[string,object]",
        "query_id" => "string",
        "redirect_id" => "string",
        "result_id" => "string",
        "type" => "string",
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        "banner_id" => null,
        "metadata" => null,
        "query_id" => null,
        "redirect_id" => null,
        "result_id" => null,
        "type" => null,
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
        "banner_id" => "banner_id",
        "metadata" => "metadata",
        "query_id" => "query_id",
        "redirect_id" => "redirect_id",
        "result_id" => "result_id",
        "type" => "type",
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        "banner_id" => "setBannerId",
        "metadata" => "setMetadata",
        "query_id" => "setQueryId",
        "redirect_id" => "setRedirectId",
        "result_id" => "setResultId",
        "type" => "setType",
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        "banner_id" => "getBannerId",
        "metadata" => "getMetadata",
        "query_id" => "getQueryId",
        "redirect_id" => "getRedirectId",
        "result_id" => "getResultId",
        "type" => "getType",
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
        $this->container["banner_id"] = $data["banner_id"] ?? null;
        $this->container["metadata"] = $data["metadata"] ?? null;
        $this->container["query_id"] = $data["query_id"] ?? null;
        $this->container["redirect_id"] = $data["redirect_id"] ?? null;
        $this->container["result_id"] = $data["result_id"] ?? null;
        $this->container["type"] = $data["type"] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container["query_id"] === null) {
            $invalidProperties[] = "'query_id' can't be null";
        }
        if ($this->container["type"] === null) {
            $invalidProperties[] = "'type' can't be null";
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
     * Gets banner_id
     *
     * @return string|null
     */
    public function getBannerId()
    {
        return $this->container["banner_id"];
    }

    /**
     * Sets banner_id
     *
     * @param string|null $banner_id The identifier of the promotion banner the event is about.
     *
     * @return self
     */
    public function setBannerId($banner_id)
    {
        $this->container["banner_id"] = $banner_id;

        return $this;
    }

    /**
     * Gets metadata
     *
     * @return map[string,object]|null
     */
    public function getMetadata()
    {
        return $this->container["metadata"];
    }

    /**
     * Sets metadata
     *
     * @param map[string,object]|null $metadata An object made up of field-value pairs that contains additional metadata to record with the event.
     *
     * @return self
     */
    public function setMetadata($metadata)
    {
        $this->container["metadata"] = $metadata;

        return $this;
    }

    /**
     * Gets query_id
     *
     * @return string
     */
    public function getQueryId()
    {
        return $this->container["query_id"];
    }

    /**
     * Sets query_id
     *
     * @param string $query_id The query identifier.
     *
     * @return self
     */
    public function setQueryId($query_id)
    {
        $this->container["query_id"] = $query_id;

        return $this;
    }

    /**
     * Gets redirect_id
     *
     * @return string|null
     */
    public function getRedirectId()
    {
        return $this->container["redirect_id"];
    }

    /**
     * Sets redirect_id
     *
     * @param string|null $redirect_id The identifier of the redirect the event is about.
     *
     * @return self
     */
    public function setRedirectId($redirect_id)
    {
        $this->container["redirect_id"] = $redirect_id;

        return $this;
    }

    /**
     * Gets result_id
     *
     * @return string|null
     */
    public function getResultId()
    {
        return $this->container["result_id"];
    }

    /**
     * Sets result_id
     *
     * @param string|null $result_id The identifier of the result the event is about.
     *
     * @return self
     */
    public function setResultId($result_id)
    {
        $this->container["result_id"] = $result_id;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container["type"];
    }

    /**
     * Sets type
     *
     * @param string $type The type of event, e.g. `click`, `redirect`, `purchase`, `add_to_cart`.
     *
     * @return self
     */
    public function setType($type)
    {
        $this->container["type"] = $type;

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
