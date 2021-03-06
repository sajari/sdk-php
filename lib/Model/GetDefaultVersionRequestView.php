<?php
/**
 * GetDefaultVersionRequestView
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
use Sajari\ObjectSerializer;

/**
 * GetDefaultVersionRequestView Class Doc Comment
 *
 * @category Class
 * @description - VIEW_UNSPECIFIED: The default / unset value. The API defaults to the &#x60;BASIC&#x60; view.  - BASIC: Include basic information including type, name, version and description but not the full step configuration. This is the default value (for both [ListPipelines](/api#operation/ListPipelines) and [GetPipeline](/api#operation/GetPipeline)).  - FULL: Include the information from &#x60;BASIC&#x60;, plus full step configuration.
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class GetDefaultVersionRequestView
{
    /**
     * Possible values of this enum
     */
    const VIEW_UNSPECIFIED = "VIEW_UNSPECIFIED";
    const BASIC = "BASIC";
    const FULL = "FULL";

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [self::VIEW_UNSPECIFIED, self::BASIC, self::FULL];
    }
}
