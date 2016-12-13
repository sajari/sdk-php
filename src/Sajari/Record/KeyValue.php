<?php

namespace Sajari\Record;

class KeyValue
{
    /** @var Key $key */
    private $key;
    /** @var Value[] $values */
    private $values;

    /**
     * KeyValue constructor.
     * @param Key $key
     * @param Value[] $value
     */
    public function __construct(Key $key, array $values)
    {
        $this->key = $key;
        $this->values = $values;
    }

    /**
     * @return Key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return Value[]
     */
    public function getValues()
    {
        return $this->values;
    }
}
