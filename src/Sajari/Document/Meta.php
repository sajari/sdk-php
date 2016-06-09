<?php

namespace Sajari\Document;

class Meta
{
    private $key;
    private $value;

    /**
     * Meta constructor.
     * @param $key
     * @param $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return \sajari\engine\store\doc\KeysMetas\KeyMeta\MetaEntry
     */
    public function Proto()
    {
        $protoMeta = new \sajari\engine\store\doc\KeysMetas\KeyMeta\MetaEntry();
        $protoMeta->setKey($this->key);
        $protoMeta->setValue(json_encode($this->value));
        return $protoMeta;
    }
}