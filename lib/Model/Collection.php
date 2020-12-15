<?php
/**
 * Collection
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
 * Collection Class Doc Comment
 *
 * @category Class
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Collection implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = "Collection";

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        "id" => "string",
        "account_id" => "string",
        "create_time" => "\DateTime",
        "display_name" => "string",
        "authorized_query_domains" => "string[]",
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        "id" => null,
        "account_id" => null,
        "create_time" => "date-time",
        "display_name" => null,
        "authorized_query_domains" => null,
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
        "id" => "id",
        "account_id" => "account_id",
        "create_time" => "create_time",
        "display_name" => "display_name",
        "authorized_query_domains" => "authorized_query_domains",
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        "id" => "setId",
        "account_id" => "setAccountId",
        "create_time" => "setCreateTime",
        "display_name" => "setDisplayName",
        "authorized_query_domains" => "setAuthorizedQueryDomains",
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        "id" => "getId",
        "account_id" => "getAccountId",
        "create_time" => "getCreateTime",
        "display_name" => "getDisplayName",
        "authorized_query_domains" => "getAuthorizedQueryDomains",
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
        $this->container["id"] = $data["id"] ?? null;
        $this->container["account_id"] = $data["account_id"] ?? null;
        $this->container["create_time"] = $data["create_time"] ?? null;
        $this->container["display_name"] = $data["display_name"] ?? null;
        $this->container["authorized_query_domains"] =
            $data["authorized_query_domains"] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container["display_name"] === null) {
            $invalidProperties[] = "'display_name' can't be null";
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
     * @param string|null $id Output only. The collection's ID.
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container["id"] = $id;

        return $this;
    }

    /**
     * Gets account_id
     *
     * @return string|null
     */
    public function getAccountId()
    {
        return $this->container["account_id"];
    }

    /**
     * Sets account_id
     *
     * @param string|null $account_id Output only. The ID of the account that owns this collection.
     *
     * @return self
     */
    public function setAccountId($account_id)
    {
        $this->container["account_id"] = $account_id;

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
     * @param \DateTime|null $create_time Output only. Creation time of the collection.
     *
     * @return self
     */
    public function setCreateTime($create_time)
    {
        $this->container["create_time"] = $create_time;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->container["display_name"];
    }

    /**
     * Sets display_name
     *
     * @param string $display_name The collection's display name. You can change this at any time.
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {
        $this->container["display_name"] = $display_name;

        return $this;
    }

    /**
     * Gets authorized_query_domains
     *
     * @return string[]|null
     */
    public function getAuthorizedQueryDomains()
    {
        return $this->container["authorized_query_domains"];
    }

    /**
     * Sets authorized_query_domains
     *
     * @param string[]|null $authorized_query_domains The list of authorized query domains for the collection.  Client-side / browser requests to the [QueryCollection](/docs/api-reference#operation/QueryCollection) call can be made by any authorized query domain or any of its subdomains. This allows your interface to make search requests without having to provide an API key in the client-side request.
     *
     * @return self
     */
    public function setAuthorizedQueryDomains($authorized_query_domains)
    {
        $this->container[
            "authorized_query_domains"
        ] = $authorized_query_domains;

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
