<?php

namespace Sajari\Internal;

class Key
{
    public static function fromProtoKeys($protoKeys)
    {
        $keys = [];
        foreach ($protoKeys as $protoKey) {
            $keys[] = Key::fromProto($protoKey);
        }
        return $keys;
    }

    /**
     * @param \Sajari\Engine\Key $engineKey
     * @return \Sajari\Key
     */
    public static function fromProto(\Sajari\Engine\Key $engineKey)
    {
        $value = Value::fromProto($engineKey->getValue());
        return new \Sajari\Key($engineKey->getField(), $value);
    }

    /**
     * @param array $keys
     * @return \Sajari\Engine\Store\Record\Keys
     */
    public static function toProtoKeys(array $keys)
    {
        $protoKeys = new \Sajari\Engine\Store\Record\Keys();
        foreach ($keys as $k) {
            $protoKeys->getKeys()[] = Key::toProto($k);
        }
        return $protoKeys;
    }

    /**
     * @param \Sajari\Key
     * @return \Sajari\Engine\Key
     */
    public static function toProto(\Sajari\Key $key)
    {
        $protoKey = new \Sajari\Engine\Key();
        $protoKey->setField($key->getField());
        $value = Value::toProto($key->getValue());
        $protoKey->setValue($value);
        return $protoKey;
    }
}