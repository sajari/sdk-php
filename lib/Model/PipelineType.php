<?php
/**
 * PipelineType
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
use Sajari\ObjectSerializer;

/**
 * PipelineType Class Doc Comment
 *
 * @category Class
 * @description - TYPE_UNSPECIFIED: Pipeline type not specified.  - RECORD: Record pipeline.  - QUERY: Query pipeline.
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class PipelineType
{
    /**
     * Possible values of this enum
     */
    const TYPE_UNSPECIFIED = "TYPE_UNSPECIFIED";
    const RECORD = "RECORD";
    const QUERY = "QUERY";

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [self::TYPE_UNSPECIFIED, self::RECORD, self::QUERY];
    }
}
