<?php

use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Deserializer;
use EventSourced\ValueObject\ValueObject\NonNullableComposite;

class NonNullableCompositesTest extends \PHPUnit_Framework_TestCase
{
    private $deserializer;

    public function setUp()
    {
        $reflector = new Reflector();
        $extensions = new EventSourced\ValueObject\Extensions\ExtensionRepository();
        $this->deserializer = new Deserializer\Deserializer($reflector, $extensions);
        parent::setUp();
    }

    public function test_deserialises_into_objects()
    {
        $serialized = [
            'property_1' => null,
            'property_2' => null
        ];

        $vo = $this->deserializer->deserialize(NonNullableComposite::class, $serialized);

        $this->assertNotEmpty($vo);
    }
}