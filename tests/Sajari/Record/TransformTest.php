<?php

namespace Sajari\Record;

class TransformTest extends \PHPUnit_Framework_TestCase
{
    public function testTransformProto()
    {
        $identifier = 'test-transform';
        $expectedProto = new \sajari\engine\store\record\Transform();
        $expectedProto->setIdentifier($identifier);

        $this->assertEquals(
            $expectedProto,
            (new Transform($identifier))->Proto()
        );
    }

    public function testStopStemmerTransform()
    {
        $this->assertSame(
            'stop-stemmer',
            Transform::StopStemmerTransform()->Proto()->getIdentifier()
        );
    }

    public function testSplitIndexFieldsTransform()
    {
        $this->assertSame(
            'split-index-fields',
            Transform::SplitIndexFieldsTransform()->Proto()->getIdentifier()
        );
    }
}