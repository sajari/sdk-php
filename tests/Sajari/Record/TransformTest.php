<?php

namespace Sajari\Record;

class TransformTest extends \PHPUnit_Framework_TestCase
{
    public function testTransformProto()
    {
        $identifier = 'test-transform';
        $expectedProto = new \sajariGen\engine\store\record\Transform();
        $expectedProto->setIdentifier($identifier);

        $this->assertEquals(
            $expectedProto,
            (new Transform($identifier))->Proto()
        );
    }

    public function testStopStemmer()
    {
        $this->assertSame(
            'stop-stem',
            Transform::StopStem()->Proto()->getIdentifier()
        );
    }

    public function testSplitIndexFields()
    {
        $this->assertSame(
            'split-indexed-fields',
            Transform::SplitIndexedFields()->Proto()->getIdentifier()
        );
    }

    public function testSplitStopStemIndexedFields()
    {
        $this->assertSame(
            'split-stop-stem-indexed-fields',
            Transform::SplitStopStemIndexedFields()->Proto()->getIdentifier()
        );
    }
}
