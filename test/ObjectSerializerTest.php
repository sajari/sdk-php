<?php

namespace Sajari\Test;

use PHPUnit\Framework\TestCase;
use Sajari\Model\PipelineStep;
use Sajari\ObjectSerializer;

class ObjectSerializerTest extends TestCase
{
    public function testDeserializeEmptyMap()
    {
        $content = '{"id": "test", "params": {}}';
        $want = new PipelineStep();
        $want->setId("test");
        $want->setParams(new \stdClass());
        $got = ObjectSerializer::deserialize(
            $content,
            "\Sajari\Model\PipelineStep",
            []
        );
        $this->assertEquals($want, $got);
    }
}
