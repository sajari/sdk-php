<?php

namespace Sajari\Search;

/**
 * @param string $fieldLat
 * @param string $fieldLng
 * @param float $lat
 * @param float $lng
 * @param float $radius
 * @param float $value
 * @return GeoMetaBoost
 */
function BoostInsideRegion($fieldLat, $fieldLng, $lat, $lng, $radius, $value) {
    return new GeoMetaBoost($fieldLat, $fieldLng, $lat, $lng, $radius, $value, \sajari\engine\query\MetaBoost\Geo\Region::INSIDE);
}

/**
 * @param string $fieldLat
 * @param string $fieldLng
 * @param float $lat
 * @param float $lng
 * @param float $radius
 * @param float $value
 * @return GeoMetaBoost
 */
function BoostOutsideRegion($fieldLat, $fieldLng, $lat, $lng, $radius, $value) {
    return new GeoMetaBoost($fieldLat, $fieldLng, $lat, $lng, $radius, $value, \sajari\engine\query\MetaBoost\Geo\Region::OUTSIDE);
}

class GeoMetaBoost extends MetaBoost
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
    /** @var float $value */
    private $value;
    /** @var int $region */
    private $region;

    /**
     * GeoMetaBoost constructor.
     * @param string $fieldLat
     * @param string $fieldLng
     * @param float $lat
     * @param float $lng
     * @param float $radius
     * @param float $value
     * @param int $region
     */
    public function __construct($fieldLat, $fieldLng, $lat, $lng, $radius, $value, $region)
    {
        $this->fieldLat = $fieldLat;
        $this->fieldLng = $fieldLng;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->radius = $radius;
        $this->value = $value;
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
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getRegion()
    {
        return $this->region;
    }

    public function Proto()
    {
        $gmb = new engine\query\MetaBoost\Geo();
        $gmb->setFieldLat($this->fieldLat);
        $gmb->setFieldLng($this->fieldLng);
        $gmb->setLat($this->lat);
        $gmb->setLng($this->lng);
        $gmb->setRadius($this->radius);
        $gmb->setValue($this->value);
        $gmb->setRegion($this->region);

        $mb = new engine\query\MetaBoost();
        $mb->setGeo($gmb);
        return $mb;
    }
}