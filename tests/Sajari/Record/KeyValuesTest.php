<?php

class KeyValuesTest extends \PHPUnit_Framework_TestCase
{
    private $keysValuesTestValues;

    public static function protoKeyValues($keyValues)
    {
        list($key, $values) = $keyValues;
        $protoKeyValue = new \sajariGen\engine\store\record\KeysValues\KeyValues();
        $protoKeyValue->setKey((new \Sajari\Engine\Key($key[0], $key[1]))->Proto());
        foreach ($values as $value) {
            $protoKeyValue->addValues((new \Sajari\Record\KeyValue($value[0], $value[1]))->Proto());
        }
        return [$keyValues, $protoKeyValue];
    }

    public function __construct()
    {
        parent::__construct();
        $this->keysValuesTestValues = array_map(
            "self::protoKeyValues",
            [
                [["key1", "value1"], [["key2", "value2"]]]
            ]
        );
    }

    public function testGetKey()
    {
        foreach ($this->keysValuesTestValues as list($keyValues, $protoKeyValues)) {
            $key = new \Sajari\Engine\Key($keyValues[0][0], $keyValues[0][1]);
            $this->assertSame(
                $key,
                (new \Sajari\Record\KeyValues($key, []))->getKey()
            );
        }
    }

    public function testGetValues()
    {
        foreach ($this->keysValuesTestValues as list($keyValues, $protoKeyValues)) {
            $key = new \Sajari\Engine\Key($keyValues[0][0], $keyValues[0][1]);
            $values = [];
            foreach ($keyValues[1] as $keyValue) {
                $values[] = new \Sajari\Record\KeyValue($keyValue[0], $keyValue[1]);
            }
            $this->assertSame(
                $values,
                (new \Sajari\Record\KeyValues($key, $values))->getValues()
            );
        }
    }

    public function testToProto()
    {
        foreach ($this->keysValuesTestValues as list($keyValues, $protoKeyValues)) {
            $key = new \Sajari\Engine\Key($keyValues[0][0], $keyValues[0][1]);
            $values = [];
            foreach ($keyValues[1] as $keyValue) {
                $values[] = new \Sajari\Record\KeyValue($keyValue[0], $keyValue[1]);
            }
            $this->assertEquals(
                $protoKeyValues,
                (new \Sajari\Record\KeyValues($key, $values))->Proto()
            );
        }
    }
}
