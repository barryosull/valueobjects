<?php

use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Serializer;
use EventSourced\ValueObject\ValueObject\NonNullableComposite;
use EventSourced\ValueObject\ValueObject\AcceptAnything;

class NonNullableCompositeTest extends \PHPUnit_Framework_TestCase
{
    private $serializer;

    public function setUp()
    {
        $reflector = new Reflector();
        $extensions = new EventSourced\ValueObject\Extensions\ExtensionRepository();
        $this->serializer = new Serializer\Serializer($reflector, $extensions);
        parent::setUp();
    }

    public function test_deserialises_into_objects()
    {
        $vo = new NonNullableComposite(new AcceptAnything(null), new AcceptAnything(null));

        $actual = $this->serializer->serialize($vo);

        $expected = [
            'property_1' => null,
            'property_2' => null
        ];

        $this->assertEquals($expected, $actual);
    }
}