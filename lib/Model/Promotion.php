<?php
/**
 * Promotion
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
 * Search.io offers a search and discovery service with Neuralsearch®, the world's first instant AI search technology. Businesses of all sizes use Search.io to build site search and discovery solutions that maximize e-commerce revenue, optimize on-site customer experience, and scale their online presence.
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
 * Promotion Class Doc Comment
 *
 * @category Class
 * @description Promotion contains a trigger, determining which searches it should be active for, and a list of alterations that should be made to search results when it is active.
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Promotion implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = "Promotion";

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        "banners" => "\Sajari\Model\Banner[]",
        "collection_id" => "string",
        "condition" => "string",
        "create_time" => "\DateTime",
        "disabled" => "bool",
        "display_name" => "string",
        "end_time" => "\DateTime",
        "exclusions" => "\Sajari\Model\PromotionExclusion[]",
        "filter_boosts" => "\Sajari\Model\PromotionFilterBoost[]",
        "filter_conditions" => "\Sajari\Model\PromotionFilterCondition[]",
        "id" => "string",
        "pins" => "\Sajari\Model\PromotionPin[]",
        "range_boosts" => "\Sajari\Model\PromotionRangeBoost[]",
        "start_time" => "\DateTime",
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
        "banners" => null,
        "collection_id" => null,
        "condition" => null,
        "create_time" => "date-time",
        "disabled" => null,
        "display_name" => null,
        "end_time" => "date-time",
        "exclusions" => null,
        "filter_boosts" => null,
        "filter_conditions" => null,
        "id" => null,
        "pins" => null,
        "range_boosts" => null,
        "start_time" => "date-time",
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
        "banners" => "banners",
        "collection_id" => "collection_id",
        "condition" => "condition",
        "create_time" => "create_time",
        "disabled" => "disabled",
        "display_name" => "display_name",
        "end_time" => "end_time",
        "exclusions" => "exclusions",
        "filter_boosts" => "filter_boosts",
        "filter_conditions" => "filter_conditions",
        "id" => "id",
        "pins" => "pins",
        "range_boosts" => "range_boosts",
        "start_time" => "start_time",
        "update_time" => "update_time",
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        "banners" => "setBanners",
        "collection_id" => "setCollectionId",
        "condition" => "setCondition",
        "create_time" => "setCreateTime",
        "disabled" => "setDisabled",
        "display_name" => "setDisplayName",
        "end_time" => "setEndTime",
        "exclusions" => "setExclusions",
        "filter_boosts" => "setFilterBoosts",
        "filter_conditions" => "setFilterConditions",
        "id" => "setId",
        "pins" => "setPins",
        "range_boosts" => "setRangeBoosts",
        "start_time" => "setStartTime",
        "update_time" => "setUpdateTime",
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        "banners" => "getBanners",
        "collection_id" => "getCollectionId",
        "condition" => "getCondition",
        "create_time" => "getCreateTime",
        "disabled" => "getDisabled",
        "display_name" => "getDisplayName",
        "end_time" => "getEndTime",
        "exclusions" => "getExclusions",
        "filter_boosts" => "getFilterBoosts",
        "filter_conditions" => "getFilterConditions",
        "id" => "getId",
        "pins" => "getPins",
        "range_boosts" => "getRangeBoosts",
        "start_time" => "getStartTime",
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
        $this->container["banners"] = $data["banners"] ?? null;
        $this->container["collection_id"] = $data["collection_id"] ?? null;
        $this->container["condition"] = $data["condition"] ?? null;
        $this->container["create_time"] = $data["create_time"] ?? null;
        $this->container["disabled"] = $data["disabled"] ?? null;
        $this->container["display_name"] = $data["display_name"] ?? null;
        $this->container["end_time"] = $data["end_time"] ?? null;
        $this->container["exclusions"] = $data["exclusions"] ?? null;
        $this->container["filter_boosts"] = $data["filter_boosts"] ?? null;
        $this->container["filter_conditions"] =
            $data["filter_conditions"] ?? null;
        $this->container["id"] = $data["id"] ?? null;
        $this->container["pins"] = $data["pins"] ?? null;
        $this->container["range_boosts"] = $data["range_boosts"] ?? null;
        $this->container["start_time"] = $data["start_time"] ?? null;
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
     * Gets banners
     *
     * @return \Sajari\Model\Banner[]|null
     */
    public function getBanners()
    {
        return $this->container["banners"];
    }

    /**
     * Sets banners
     *
     * @param \Sajari\Model\Banner[]|null $banners The banners that are injected into the result set when the promotion is triggered.
     *
     * @return self
     */
    public function setBanners($banners)
    {
        $this->container["banners"] = $banners;

        return $this;
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
     * @param string|null $collection_id Output only. The ID of the collection that owns this promotion.
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
     * @param string $condition A condition expression applied to a search request that determines which searches the promotion is active for.  For example, to apply the promotion's pins and boosts whenever a user searches for 'shoes' set condition to `q = 'shoes'`.
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
     * @param \DateTime|null $create_time Output only. Time the promotion was created.
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
     * @param bool|null $disabled If disabled, the promotion is never triggered.
     *
     * @return self
     */
    public function setDisabled($disabled)
    {
        $this->container["disabled"] = $disabled;

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
     * @param string $display_name The promotion's display name.
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {
        $this->container["display_name"] = $display_name;

        return $this;
    }

    /**
     * Gets end_time
     *
     * @return \DateTime|null
     */
    public function getEndTime()
    {
        return $this->container["end_time"];
    }

    /**
     * Sets end_time
     *
     * @param \DateTime|null $end_time If specified, the promotion is considered disabled after this time.
     *
     * @return self
     */
    public function setEndTime($end_time)
    {
        $this->container["end_time"] = $end_time;

        return $this;
    }

    /**
     * Gets exclusions
     *
     * @return \Sajari\Model\PromotionExclusion[]|null
     */
    public function getExclusions()
    {
        return $this->container["exclusions"];
    }

    /**
     * Sets exclusions
     *
     * @param \Sajari\Model\PromotionExclusion[]|null $exclusions The records to exclude from search results, if the promotion is enabled.
     *
     * @return self
     */
    public function setExclusions($exclusions)
    {
        $this->container["exclusions"] = $exclusions;

        return $this;
    }

    /**
     * Gets filter_boosts
     *
     * @return \Sajari\Model\PromotionFilterBoost[]|null
     */
    public function getFilterBoosts()
    {
        return $this->container["filter_boosts"];
    }

    /**
     * Sets filter_boosts
     *
     * @param \Sajari\Model\PromotionFilterBoost[]|null $filter_boosts The filter boosts to apply to searches, if the promotion is enabled.
     *
     * @return self
     */
    public function setFilterBoosts($filter_boosts)
    {
        $this->container["filter_boosts"] = $filter_boosts;

        return $this;
    }

    /**
     * Gets filter_conditions
     *
     * @return \Sajari\Model\PromotionFilterCondition[]|null
     */
    public function getFilterConditions()
    {
        return $this->container["filter_conditions"];
    }

    /**
     * Sets filter_conditions
     *
     * @param \Sajari\Model\PromotionFilterCondition[]|null $filter_conditions The conditions applied to the filters passed from the user. A query must match at least one of these in order to trigger the promotion.
     *
     * @return self
     */
    public function setFilterConditions($filter_conditions)
    {
        $this->container["filter_conditions"] = $filter_conditions;

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
     * @param string|null $id The promotion's ID.
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container["id"] = $id;

        return $this;
    }

    /**
     * Gets pins
     *
     * @return \Sajari\Model\PromotionPin[]|null
     */
    public function getPins()
    {
        return $this->container["pins"];
    }

    /**
     * Sets pins
     *
     * @param \Sajari\Model\PromotionPin[]|null $pins The items to fix to specific positions in the search results.
     *
     * @return self
     */
    public function setPins($pins)
    {
        $this->container["pins"] = $pins;

        return $this;
    }

    /**
     * Gets range_boosts
     *
     * @return \Sajari\Model\PromotionRangeBoost[]|null
     */
    public function getRangeBoosts()
    {
        return $this->container["range_boosts"];
    }

    /**
     * Sets range_boosts
     *
     * @param \Sajari\Model\PromotionRangeBoost[]|null $range_boosts The range boosts to apply to searches, if the promotion is enabled.
     *
     * @return self
     */
    public function setRangeBoosts($range_boosts)
    {
        $this->container["range_boosts"] = $range_boosts;

        return $this;
    }

    /**
     * Gets start_time
     *
     * @return \DateTime|null
     */
    public function getStartTime()
    {
        return $this->container["start_time"];
    }

    /**
     * Sets start_time
     *
     * @param \DateTime|null $start_time If specified, the promotion is considered disabled before this time.
     *
     * @return self
     */
    public function setStartTime($start_time)
    {
        $this->container["start_time"] = $start_time;

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
     * @param \DateTime|null $update_time Output only. Time the promotion was last updated.
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
