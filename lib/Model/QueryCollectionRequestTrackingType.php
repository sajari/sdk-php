<?php
/**
 * QueryCollectionRequestTrackingType
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
 * QueryCollectionRequestTrackingType Class Doc Comment
 *
 * @category Class
 * @description - TYPE_UNSPECIFIED: The default / unset value. The API defaults to &#x60;NONE&#x60; tracking.  - NONE: No tracking.  - CLICK: Click tracking.  A click token is be generated for each result. Results which do not receive clicks fall down the rankings, and similarly low-ranked records which receive clicks are moved up the rankings.  - POS_NEG: Pos/neg tracking.  Pos/neg tokens are generated for each result. Each record in the result set can be marked with pos/neg value for the search. This is then fed back into the ranking algorithm to improve future results. Unlike &#x60;CLICK&#x60;, if no tokens are reported for records then no action is taken.  - EVENT: Event tracking.  A query identifier is returned in the [QueryResponse][sajari.v4.QueryResponse] that can be used to link a user interaction to a specific query.
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class QueryCollectionRequestTrackingType
{
    /**
     * Possible values of this enum
     */
    const TYPE_UNSPECIFIED = "TYPE_UNSPECIFIED";
    const NONE = "NONE";
    const CLICK = "CLICK";
    const POS_NEG = "POS_NEG";
    const EVENT = "EVENT";

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::TYPE_UNSPECIFIED,
            self::NONE,
            self::CLICK,
            self::POS_NEG,
            self::EVENT,
        ];
    }
}
