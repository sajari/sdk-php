<?php
/**
 * ProtobufFieldMask
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
 * ProtobufFieldMask Class Doc Comment
 *
 * @category Class
 * @description paths: \&quot;f.a\&quot;     paths: \&quot;f.b.d\&quot;  Here &#x60;f&#x60; represents a field in some root message, &#x60;a&#x60; and &#x60;b&#x60; fields in the message found in &#x60;f&#x60;, and &#x60;d&#x60; a field found in the message in &#x60;f.b&#x60;.  Field masks are used to specify a subset of fields that should be returned by a get operation or modified by an update operation. Field masks also have a custom JSON encoding (see below).  # Field Masks in Projections  When used in the context of a projection, a response message or sub-message is filtered by the API to only contain those fields as specified in the mask. For example, if the mask in the previous example is applied to a response message as follows:      f {       a : 22       b {         d : 1         x : 2       }       y : 13     }     z: 8  The result will not contain specific values for fields x,y and z (their value will be set to the default, and omitted in proto text output):       f {       a : 22       b {         d : 1       }     }  A repeated field is not allowed except at the last position of a paths string.  If a FieldMask object is not present in a get operation, the operation applies to all fields (as if a FieldMask of all fields had been specified).  Note that a field mask does not necessarily apply to the top-level response message. In case of a REST get operation, the field mask applies directly to the response, but in case of a REST list operation, the mask instead applies to each individual message in the returned resource list. In case of a REST custom method, other definitions may be used. Where the mask applies will be clearly documented together with its declaration in the API.  In any case, the effect on the returned resource/resources is required behavior for APIs.  # Field Masks in Update Operations  A field mask in update operations specifies which fields of the targeted resource are going to be updated. The API is required to only change the values of the fields as specified in the mask and leave the others untouched. If a resource is passed in to describe the updated values, the API ignores the values of all fields not covered by the mask.  If a repeated field is specified for an update operation, new values will be appended to the existing repeated field in the target resource. Note that a repeated field is only allowed in the last position of a &#x60;paths&#x60; string.  If a sub-message is specified in the last position of the field mask for an update operation, then new value will be merged into the existing sub-message in the target resource.  For example, given the target message:      f {       b {         d: 1         x: 2       }       c: [1]     }  And an update message:      f {       b {         d: 10       }       c: [2]     }  then if the field mask is:   paths: [\&quot;f.b\&quot;, \&quot;f.c\&quot;]  then the result will be:      f {       b {         d: 10         x: 2       }       c: [1, 2]     }  An implementation may provide options to override this default behavior for repeated and message fields.  In order to reset a field&#39;s value to the default, the field must be in the mask and set to the default value in the provided resource. Hence, in order to reset all fields of a resource, provide a default instance of the resource and set all fields in the mask, or do not provide a mask as described below.  If a field mask is not present on update, the operation applies to all fields (as if a field mask of all fields has been specified). Note that in the presence of schema evolution, this may mean that fields the client does not know and has therefore not filled into the request will be reset to their default. If this is unwanted behavior, a specific service may require a client to always specify a field mask, producing an error if not.  As with get operations, the location of the resource which describes the updated values in the request message depends on the operation kind. In any case, the effect of the field mask is required to be honored by the API.  ## Considerations for HTTP REST  The HTTP kind of an update operation which uses a field mask must be set to PATCH instead of PUT in order to satisfy HTTP semantics (PUT must only be used for full updates).  # JSON Encoding of Field Masks  In JSON, a field mask is encoded as a single string where paths are separated by a comma. Fields name in each path are converted to/from lower-camel naming conventions.  As an example, consider the following message declarations:      message Profile {       User user &#x3D; 1;       Photo photo &#x3D; 2;     }     message User {       string display_name &#x3D; 1;       string address &#x3D; 2;     }  In proto a field mask for &#x60;Profile&#x60; may look as such:      mask {       paths: \&quot;user.display_name\&quot;       paths: \&quot;photo\&quot;     }  In JSON, the same mask is represented as below:      {       mask: \&quot;user.displayName,photo\&quot;     }  # Field Masks and Oneof Fields  Field masks treat fields in oneofs just as regular fields. Consider the following message:      message SampleMessage {       oneof test_oneof {         string name &#x3D; 4;         SubMessage sub_message &#x3D; 9;       }     }  The field mask can be:      mask {       paths: \&quot;name\&quot;     }  Or:      mask {       paths: \&quot;sub_message\&quot;     }  Note that oneof type names (\&quot;test_oneof\&quot; in this case) cannot be used in paths.  ## Field Mask Verification  The implementation of any API method which has a FieldMask type field in the request should verify the included field paths, and return an &#x60;INVALID_ARGUMENT&#x60; error if any path is unmappable.
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class ProtobufFieldMask implements
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
    protected static $openAPIModelName = "protobufFieldMask";

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        "paths" => "string[]",
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        "paths" => null,
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
        "paths" => "paths",
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        "paths" => "setPaths",
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        "paths" => "getPaths",
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
        $this->container["paths"] = $data["paths"] ?? null;
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
     * Gets paths
     *
     * @return string[]|null
     */
    public function getPaths()
    {
        return $this->container["paths"];
    }

    /**
     * Sets paths
     *
     * @param string[]|null $paths The set of field mask paths.
     *
     * @return self
     */
    public function setPaths($paths)
    {
        $this->container["paths"] = $paths;

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
