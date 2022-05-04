<?php
/**
 * Banner
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
 * Banner Class Doc Comment
 *
 * @category Class
 * @description A synthetic search result that renders as an image. It takes a user to a pre-determined location when clicked.
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Banner implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = "Banner";

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        "description" => "string",
        "height" => "int",
        "id" => "string",
        "image_url" => "string",
        "position" => "int",
        "target_url" => "string",
        "text_color" => "string",
        "text_position" => "\Sajari\Model\TextPosition",
        "title" => "string",
        "width" => "int",
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        "description" => null,
        "height" => "int32",
        "id" => null,
        "image_url" => null,
        "position" => "int32",
        "target_url" => null,
        "text_color" => null,
        "text_position" => null,
        "title" => null,
        "width" => "int32",
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
        "description" => "description",
        "height" => "height",
        "id" => "id",
        "image_url" => "image_url",
        "position" => "position",
        "target_url" => "target_url",
        "text_color" => "text_color",
        "text_position" => "text_position",
        "title" => "title",
        "width" => "width",
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        "description" => "setDescription",
        "height" => "setHeight",
        "id" => "setId",
        "image_url" => "setImageUrl",
        "position" => "setPosition",
        "target_url" => "setTargetUrl",
        "text_color" => "setTextColor",
        "text_position" => "setTextPosition",
        "title" => "setTitle",
        "width" => "setWidth",
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        "description" => "getDescription",
        "height" => "getHeight",
        "id" => "getId",
        "image_url" => "getImageUrl",
        "position" => "getPosition",
        "target_url" => "getTargetUrl",
        "text_color" => "getTextColor",
        "text_position" => "getTextPosition",
        "title" => "getTitle",
        "width" => "getWidth",
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
        $this->container["description"] = $data["description"] ?? null;
        $this->container["height"] = $data["height"] ?? null;
        $this->container["id"] = $data["id"] ?? null;
        $this->container["image_url"] = $data["image_url"] ?? null;
        $this->container["position"] = $data["position"] ?? null;
        $this->container["target_url"] = $data["target_url"] ?? null;
        $this->container["text_color"] = $data["text_color"] ?? null;
        $this->container["text_position"] = $data["text_position"] ?? null;
        $this->container["title"] = $data["title"] ?? null;
        $this->container["width"] = $data["width"] ?? null;
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
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container["description"];
    }

    /**
     * Sets description
     *
     * @param string|null $description The description of the banner, displayed in sub-head font.
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->container["description"] = $description;

        return $this;
    }

    /**
     * Gets height
     *
     * @return int|null
     */
    public function getHeight()
    {
        return $this->container["height"];
    }

    /**
     * Sets height
     *
     * @param int|null $height The height the banner occupies in grid cells.
     *
     * @return self
     */
    public function setHeight($height)
    {
        $this->container["height"] = $height;

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
     * @param string|null $id The ID of the banner, used to identify clicked banners.
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container["id"] = $id;

        return $this;
    }

    /**
     * Gets image_url
     *
     * @return string|null
     */
    public function getImageUrl()
    {
        return $this->container["image_url"];
    }

    /**
     * Sets image_url
     *
     * @param string|null $image_url The URL of the image used for the banner.
     *
     * @return self
     */
    public function setImageUrl($image_url)
    {
        $this->container["image_url"] = $image_url;

        return $this;
    }

    /**
     * Gets position
     *
     * @return int|null
     */
    public function getPosition()
    {
        return $this->container["position"];
    }

    /**
     * Sets position
     *
     * @param int|null $position The 1-based index indicating where the banner appears in search results.
     *
     * @return self
     */
    public function setPosition($position)
    {
        $this->container["position"] = $position;

        return $this;
    }

    /**
     * Gets target_url
     *
     * @return string|null
     */
    public function getTargetUrl()
    {
        return $this->container["target_url"];
    }

    /**
     * Sets target_url
     *
     * @param string|null $target_url The URL to redirect the user to when the banner is clicked.
     *
     * @return self
     */
    public function setTargetUrl($target_url)
    {
        $this->container["target_url"] = $target_url;

        return $this;
    }

    /**
     * Gets text_color
     *
     * @return string|null
     */
    public function getTextColor()
    {
        return $this->container["text_color"];
    }

    /**
     * Sets text_color
     *
     * @param string|null $text_color The color of the text as a hex code with a # prefix, e.g. #FFCC00 or #FC0.
     *
     * @return self
     */
    public function setTextColor($text_color)
    {
        $this->container["text_color"] = $text_color;

        return $this;
    }

    /**
     * Gets text_position
     *
     * @return \Sajari\Model\TextPosition|null
     */
    public function getTextPosition()
    {
        return $this->container["text_position"];
    }

    /**
     * Sets text_position
     *
     * @param \Sajari\Model\TextPosition|null $text_position text_position
     *
     * @return self
     */
    public function setTextPosition($text_position)
    {
        $this->container["text_position"] = $text_position;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container["title"];
    }

    /**
     * Sets title
     *
     * @param string|null $title The title of the banner, displayed in header font.
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->container["title"] = $title;

        return $this;
    }

    /**
     * Gets width
     *
     * @return int|null
     */
    public function getWidth()
    {
        return $this->container["width"];
    }

    /**
     * Sets width
     *
     * @param int|null $width The width the banner occupies in grid cells.
     *
     * @return self
     */
    public function setWidth($width)
    {
        $this->container["width"] = $width;

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