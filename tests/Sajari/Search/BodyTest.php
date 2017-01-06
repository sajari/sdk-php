<?php

class BodyTest extends \PHPUnit_Framework_TestCase
{
    private $testValues;

    public static function protoBody($values)
    {
        list($text, $weight) = $values;
        $pb = new \sajari\engine\query\v1\Body();
        $pb->setText($text);
        $pb->setWeight($weight);
        return [$values, $pb];
    }

    public function __construct()
    {
        parent::__construct();
        $this->testValues = array_map(
            "self::protoBody",
            [
                ["test", 1.0]
            ]
        );
    }

    public function testToProto()
    {
        foreach ($this->testValues as $testValue) {
            list(list($text, $weight), $protoValue) = $testValue;
            $this->assertEquals(
                $protoValue,
                (new \Sajari\Search\Body($text, $weight))->Proto()
            );
        }
    }
}