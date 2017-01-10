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
            'stop-stemmer',
            Transform::StopStemmer()->Proto()->getIdentifier()
        );
    }

    public function testSplitIndexFields()
    {
        $this->assertSame(
            'split-index-fields',
            Transform::SplitIndexFields()->Proto()->getIdentifier()
        );
    }
}
