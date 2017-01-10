<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/value.php';
require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class GeoFilter
 * @package Sajari\Query
 */
class GeoFilter implements Filter, Proto
{
    /** @var string $fieldLat */
    private $fieldLat;

    /** @var string $fieldLng */
    private $fieldLng;

    /** @var float $lat */
    private $lat;

    /** @var float $lng */
    private $lng;

    /** @var float $radius */
    private $radius;

    /** @var int $region */
    private $region;

    /**
     * GeoFieldBoost constructor.
     * @param string $fieldLat
     * @param string $fieldLng
     * @param float $lat
     * @param float $lng
     * @param float $radius
     * @param int $region
     */
    public function __construct($fieldLat, $fieldLng, $lat, $lng, $radius, $region)
    {
        $this->fieldLat = $fieldLat;
        $this->fieldLng = $fieldLng;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->radius = $radius;
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getFieldLat()
    {
        return $this->fieldLat;
    }

    /**
     * @return string
     */
    public function getFieldLng()
    {
        return $this->fieldLng;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @return float
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @return int
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $fieldLat
     * @param string $fieldLng
     * @param float $lat
     * @param float $lng
     * @param float $radius
     * @return GeoFilter
     */
    public static function Inside($fieldLat, $fieldLng, $lat, $lng, $radius) {
        return new GeoFilter($fieldLat, $fieldLng, $lat, $lng, $radius, \sajari\engine\query\v1\Filter\Geo\Region::INSIDE);
    }

    /**
     * @param string $fieldLat
     * @param string $fieldLng
     * @param float $lat
     * @param float $lng
     * @param float $radius
     * @return GeoFilter
     */
    public static function Outside($fieldLat, $fieldLng, $lat, $lng, $radius) {
        return new GeoFilter($fieldLat, $fieldLng, $lat, $lng, $radius, \sajari\engine\query\v1\Filter\Geo\Region::OUTSIDE);
    }

    /**
     * @return \sajari\engine\query\v1\Filter
     */
    public function Proto()
    {
        $gmb = new \sajari\engine\query\v1\Filter\Geo();
        $gmb->setFieldLat($this->fieldLat);
        $gmb->setFieldLng($this->fieldLng);
        $gmb->setLat($this->lat);
        $gmb->setLng($this->lng);
        $gmb->setRadius($this->radius);
        $gmb->setRegion($this->region);

        $mb = new \sajari\engine\query\v1\Filter();
        $mb->setGeo($gmb);
        return $mb;
    }
}
