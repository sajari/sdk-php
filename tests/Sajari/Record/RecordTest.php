<?php

class RecordTest extends \PHPUnit_Framework_TestCase
{
    private $protoTestRecords;

    public static function protoRecordFromValues($values)
    {
        $protoRecord = new sajariGen\engine\store\record\Record();
        foreach ($values as $field => $value) {
            $valueEntry = new \sajariGen\engine\store\record\Record\ValuesEntry();
            $valueEntry->setKey($field);
            $valueEntry->setValue(\Sajari\Engine\Value::ToProto($value));
            $protoRecord->addValues($valueEntry);
        }
        return [$values, $protoRecord];
    }

    public function __construct()
    {
        parent::__construct();
        $this->protoTestRecords = array_map(
            "self::protoRecordFromValues",
            [
                ["dog" => "grey"]
            ]
        );
    }

    public function testGetValues()
    {
        foreach ($this->protoTestRecords as list($values, $protoRecord)) {
            $this->assertSame(
                $values,
                (new \Sajari\Record\Record($values))->getValues()
            );
        }
    }

    public function testFromProto()
    {
        foreach ($this->protoTestRecords as list($values, $protoRecord)) {
            $this->assertEquals(
                new \Sajari\Record\Record($values),
                \Sajari\Record\Record::FromProto($protoRecord)
            );
        }
    }

    public function testToProto()
    {
        foreach ($this->protoTestRecords as list($values, $protoRecord)) {
            $this->assertEquals(
                $protoRecord,
                (new \Sajari\Record\Record($values))->Proto()
            );
        }
    }
}
