<?php namespace EventSourced\ValueObject\Test\ValueObject;

use EventSourced\ValueObject\Extensions\ExtensionRepository;
use EventSourced\ValueObject\ValueObject\Coordinate;
use EventSourced\ValueObject\ValueObject\NullableGPSCoordinates;
use EventSourced\ValueObject\Reflector\Reflector;

class TestNullableComposite extends \PHPUnit_Framework_TestCase
{
    private $gps;
    private $deserialized = null;
    private $serializer;
    private $deserializer;

    public function setUp()
    {
        $reflector = new Reflector();
        $extensions = new ExtensionRepository();
        $this->serializer = new \EventSourced\ValueObject\Serializer\Serializer($reflector, $extensions);
        $this->deserializer = new \EventSourced\ValueObject\Deserializer\Deserializer($reflector, $extensions);
        $this->gps = new NullableGPSCoordinates();
        parent::setUp();
    }

    public function test_serialize()
    {
        $this->assertEquals($this->deserialized, $this->serializer->serialize($this->gps));
    }

    public function test_deserialize()
    {
        $gps = $this->deserializer->deserialize(NullableGPSCoordinates::class, $this->deserialized);
        $this->assertTrue($this->gps->equals($gps));
    }

    public function test_can_use_with_real_values()
    {
        $deserialized = ['latitude'=>23.9, 'longitude'=>90.0];
        $gps = new NullableGPSCoordinates(new Coordinate(23.9),  new Coordinate(90.0));

        $this->assertEquals($deserialized, $this->serializer->serialize($gps));
    }
}
