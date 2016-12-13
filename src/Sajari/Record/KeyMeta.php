<?php

namespace Sajari\Document;

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