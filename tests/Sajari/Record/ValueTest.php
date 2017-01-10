<?php

namespace Sajari\Client;

class TestValue
{
    /** @var mixed $original The original value of the test */
    public $original;
    /** @var array|null|string The stringified value of the original value */
    public $string;
    /** @var \sajariGen\engine\Value The proto value of the original value */
    public $proto;

    public function __construct($v)
    {
        $pv = new \sajariGen\engine\Value();
        if (is_array($v)) {
            $repeated = new \sajariGen\engine\Value\Repeated();
            foreach ($v as $x) {
                if ($x instanceof \DateTime) {
                    $repeated->addValues($x->format(\DateTime::ATOM));
                } else {
                    $repeated->addValues(sprintf("%s", $x));
                }
            }
            $pv->setRepeated($repeated);
        } else if (is_null($v)) {
            $pv->setNull(true);
        } else {
            if ($v instanceof \DateTime) {
                $pv->setSingle($v->format(\DateTime::ATOM));
            } else {
                $pv->setSingle(sprintf("%s", $v));
            }
        }

        $stringOfValue = null;
        if (is_array($v)) {
            $arrayOfString = [];
            foreach ($v as $x) {
                if ($x instanceof \DateTime) {
                    $arrayOfString[] = $x->format(\DateTime::ATOM);
                } else {
                    $arrayOfString[] = sprintf("%s", $x);
                }
            }
            $stringOfValue = $arrayOfString;
        } else {
            if ($v instanceof \DateTime) {
                $stringOfValue = $v->format(\DateTime::ATOM);
            } else if (is_null($v)) {
                $stringOfValue = null;
            } else {
                $stringOfValue = sprintf("%s", $v);
            }
        }

        $this->original = $v;
        $this->string = $stringOfValue;
        $this->proto = $pv;
    }
}

class ValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $v
     * @return TestValue
     */
    public static function makeProtoValue($v)
    {
        return new TestValue($v);
    }

    /** @var TestValue[] $protoValueTests */
    public $protoValueTests;

    /**
     * ValueTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->protoValueTests = array_map(
            "self::makeProtoValue",
            [
                "",
                "5",
                "dog",
                "12.34",
                [],
                [1],
                [1, 2, 3],
                ["test"],
                [new \DateTime("2015-11-01 00:00:00")],
                1,
                1.25,
                true,
                false,
                new \DateTime("2015-11-01 00:00:00"),
                null
            ]
        );
    }

    /**
     * testValueToProto Tests that Value::ToProto produces the correct proto value
     */
    public function testValueToProto()
    {
        foreach ($this->protoValueTests as $test) {
            $this->assertEquals(
                \Sajari\Engine\Value::ToProto($test->original),
                $test->proto
            );
        }
    }

    /**
     * testValueFromProto Tests that Value::FromProto produces the correct string value
     */
    public function testValueFromProto()
    {
        foreach ($this->protoValueTests as $test) {
            $this->assertSame(
                \Sajari\Engine\Value::FromProto($test->proto),
                $test->string
            );
        }
    }

    /**
     * testValueToProtoAndBack Tests that Value::ToProto • Value::FromProto produces the correct string value
     */
    public function testValueToProtoAndBack()
    {
        foreach ($this->protoValueTests as $test) {
            $this->assertSame(
                \Sajari\Engine\Value::FromProto(
                    \Sajari\Engine\Value::ToProto($test->original)
                ),
                $test->string
            );
        }
    }
}
