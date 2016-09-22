<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\FieldBoost\Geo as ProtoGeo;
use sajari\engine\query\FieldBoost as ProtoFieldBoost;

class GeoFieldBoost extends FieldBoost
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
     * GeoFieldBoost constructor.
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

    /**
     * @param string $fieldLat
     * @param string $fieldLng
     * @param float $lat
     * @param float $lng
     * @param float $radius
     * @param float $value
     * @return GeoFieldBoost
     */
    public static function Inside($fieldLat, $fieldLng, $lat, $lng, $radius, $value) {
        return new GeoFieldBoost($fieldLat, $fieldLng, $lat, $lng, $radius, $value, \sajari\engine\query\FieldBoost\Geo\Region::INSIDE);
    }

    /**
     * @param string $fieldLat
     * @param string $fieldLng
     * @param float $lat
     * @param float $lng
     * @param float $radius
     * @param float $value
     * @return GeoFieldBoost
     */
    public static function Outside($fieldLat, $fieldLng, $lat, $lng, $radius, $value) {
        return new GeoFieldBoost($fieldLat, $fieldLng, $lat, $lng, $radius, $value, \sajari\engine\query\FieldBoost\Geo\Region::OUTSIDE);
    }

    public function Proto()
    {
        $gmb = new ProtoGeo();
        $gmb->setFieldLat($this->fieldLat);
        $gmb->setFieldLng($this->fieldLng);
        $gmb->setLat($this->lat);
        $gmb->setLng($this->lng);
        $gmb->setRadius($this->radius);
        $gmb->setValue($this->value);
        $gmb->setRegion($this->region);

        $mb = new ProtoFieldBoost();
        $mb->setGeo($gmb);
        return $mb;
    }
}
