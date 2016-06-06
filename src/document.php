<?php

namespace Sajari;

class Key
{
    /** @var $field string */
    private $field;
    private $value;

    /**
     * Key constructor.
     * @param $field string
     * @param $value
     */
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return \sajari\engine\store\doc\Keys\Key
     */
    public function Proto()
    {
        $protoKey = new \sajari\engine\store\doc\Keys\Key();
        $protoKey->setField($this->field);
        $protoKey->setValue($this->value);
        return $protoKey;
    }
}
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

class KeyMeta
{
    /** @var Key $key */
    private $key;
    /** @var Meta[] $meta */
    private $meta;

    /**
     * KeyMeta constructor.
     * @param Key $key
     * @param Meta[] $meta
     */
    public function __construct(Key $key, array $meta)
    {
        $this->key = $key;
        $this->meta = $meta;
    }

    /**
     * @return Key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return Meta[]
     */
    public function getMeta()
    {
        return $this->meta;
    }
}

class Document
{
    /** @var Meta[] $meta */
    private $meta;

    /**
     * Document constructor.
     * @param $meta
     */
    public function __construct($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return Meta[]
     */
    public function getMeta()
    {
        return $this->meta;
    }


}

