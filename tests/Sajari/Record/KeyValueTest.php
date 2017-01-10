<?php

class KeyValueTest extends \PHPUnit_Framework_TestCase
{
    public function testToProto()
    {
        $key = "key";
        $value = "dog";

        $protoValue = new \sajariGen\engine\store\record\KeysValues\KeyValues\Value();
        $protoValue->setSet(\Sajari\Engine\Value::ToProto($value));
        $protoValueEntry = new \sajariGen\engine\store\record\KeysValues\KeyValues\ValuesEntry();
        $protoValueEntry->setKey($key);
        $protoValueEntry->setValue($protoValue);

        $this->assertEquals(
            $protoValueEntry,
            (new \Sajari\Record\KeyValue($key, $value))->Proto()
        );
    }
}
