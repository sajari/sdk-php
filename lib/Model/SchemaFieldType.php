<?php
/**
 * SchemaFieldType
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
use Sajari\ObjectSerializer;

/**
 * SchemaFieldType Class Doc Comment
 *
 * @category Class
 * @description Type represents the underlying data type of the field.   - TYPE_UNSPECIFIED: Type not specified.  - STRING: String values.  - INTEGER: Integer values (64-bit).  - FLOAT: Floating point values (32-bit).  - DOUBLE: Double floating point values (64-bit).  - BOOLEAN: Boolean values.  - TIMESTAMP: Timestamp values.  - BYTES: Raw byte values.
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class SchemaFieldType
{
    /**
     * Possible values of this enum
     */
    const TYPE_UNSPECIFIED = "TYPE_UNSPECIFIED";
    const STRING = "STRING";
    const INTEGER = "INTEGER";
    const FLOAT = "FLOAT";
    const DOUBLE = "DOUBLE";
    const BOOLEAN = "BOOLEAN";
    const TIMESTAMP = "TIMESTAMP";
    const BYTES = "BYTES";

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::TYPE_UNSPECIFIED,
            self::STRING,
            self::INTEGER,
            self::FLOAT,
            self::DOUBLE,
            self::BOOLEAN,
            self::TIMESTAMP,
            self::BYTES,
        ];
    }
}
