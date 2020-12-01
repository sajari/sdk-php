<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/engine/query/v1/query.proto

namespace Sajari\Engine\Query\V1\Filter;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Geo is a geo-based filter for records with lat/lng fields representing a location.
 *
 * Generated from protobuf message <code>sajari.engine.query.v1.Filter.Geo</code>
 */
class Geo extends \Google\Protobuf\Internal\Message
{
    /**
     * Field containing latitude (degrees).
     *
     * Generated from protobuf field <code>string field_lat = 1;</code>
     */
    private $field_lat = '';
    /**
     * Field containing longitude (degrees).
     *
     * Generated from protobuf field <code>string field_lng = 2;</code>
     */
    private $field_lng = '';
    /**
     * Target latitude (in degrees).
     *
     * Generated from protobuf field <code>double lat = 3;</code>
     */
    private $lat = 0.0;
    /**
     * Target longitude (in degrees).
     *
     * Generated from protobuf field <code>double lng = 4;</code>
     */
    private $lng = 0.0;
    /**
     * Radius (in km) of matching border (see region).
     *
     * Generated from protobuf field <code>double radius = 5;</code>
     */
    private $radius = 0.0;
    /**
     * Region for matching points.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.Filter.Geo.Region region = 6;</code>
     */
    private $region = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $field_lat
     *           Field containing latitude (degrees).
     *     @type string $field_lng
     *           Field containing longitude (degrees).
     *     @type float $lat
     *           Target latitude (in degrees).
     *     @type float $lng
     *           Target longitude (in degrees).
     *     @type float $radius
     *           Radius (in km) of matching border (see region).
     *     @type int $region
     *           Region for matching points.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Sajari\Engine\Query\V1\Query::initOnce();
        parent::__construct($data);
    }

    /**
     * Field containing latitude (degrees).
     *
     * Generated from protobuf field <code>string field_lat = 1;</code>
     * @return string
     */
    public function getFieldLat()
    {
        return $this->field_lat;
    }

    /**
     * Field containing latitude (degrees).
     *
     * Generated from protobuf field <code>string field_lat = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setFieldLat($var)
    {
        GPBUtil::checkString($var, True);
        $this->field_lat = $var;

        return $this;
    }

    /**
     * Field containing longitude (degrees).
     *
     * Generated from protobuf field <code>string field_lng = 2;</code>
     * @return string
     */
    public function getFieldLng()
    {
        return $this->field_lng;
    }

    /**
     * Field containing longitude (degrees).
     *
     * Generated from protobuf field <code>string field_lng = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setFieldLng($var)
    {
        GPBUtil::checkString($var, True);
        $this->field_lng = $var;

        return $this;
    }

    /**
     * Target latitude (in degrees).
     *
     * Generated from protobuf field <code>double lat = 3;</code>
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Target latitude (in degrees).
     *
     * Generated from protobuf field <code>double lat = 3;</code>
     * @param float $var
     * @return $this
     */
    public function setLat($var)
    {
        GPBUtil::checkDouble($var);
        $this->lat = $var;

        return $this;
    }

    /**
     * Target longitude (in degrees).
     *
     * Generated from protobuf field <code>double lng = 4;</code>
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Target longitude (in degrees).
     *
     * Generated from protobuf field <code>double lng = 4;</code>
     * @param float $var
     * @return $this
     */
    public function setLng($var)
    {
        GPBUtil::checkDouble($var);
        $this->lng = $var;

        return $this;
    }

    /**
     * Radius (in km) of matching border (see region).
     *
     * Generated from protobuf field <code>double radius = 5;</code>
     * @return float
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * Radius (in km) of matching border (see region).
     *
     * Generated from protobuf field <code>double radius = 5;</code>
     * @param float $var
     * @return $this
     */
    public function setRadius($var)
    {
        GPBUtil::checkDouble($var);
        $this->radius = $var;

        return $this;
    }

    /**
     * Region for matching points.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.Filter.Geo.Region region = 6;</code>
     * @return int
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Region for matching points.
     *
     * Generated from protobuf field <code>.sajari.engine.query.v1.Filter.Geo.Region region = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setRegion($var)
    {
        GPBUtil::checkEnum($var, \Sajari\Engine\Query\V1\Filter_Geo_Region::class);
        $this->region = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Geo::class, \Sajari\Engine\Query\V1\Filter_Geo::class);
