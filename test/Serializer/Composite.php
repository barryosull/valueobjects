<?php

namespace EventSourced\ValueObject\Test\ValueObject;

use EventSourced\ValueObject\Extensions\ExtensionRepository;
use EventSourced\ValueObject\ValueObject\GPSCoordinates;
use EventSourced\ValueObject\ValueObject\Coordinate;
use EventSourced\ValueObject\Reflector\Reflector;

class TestComposite extends \PHPUnit_Framework_TestCase 
{
    private $gps;
    private $deserialized = ['latitude'=>23.9, 'longitude'=>90.0];
    private $serializer;
    private $deserializer;
    
    public function setUp()
    {
        $reflector = new Reflector();
        $extensions = new ExtensionRepository();
        $this->serializer = new \EventSourced\ValueObject\Serializer\Serializer($reflector, $extensions);
        $this->deserializer = new \EventSourced\ValueObject\Deserializer\Deserializer($reflector, $extensions);
        $this->gps = new GPSCoordinates(new Coordinate(23.9),  new Coordinate(90.0));
        parent::setUp();
    }
    
    public function test_serialize()
    {
        $this->assertEquals($this->deserialized, $this->serializer->serialize($this->gps));
    }
    
    public function test_deserialize()
    {
        $gps = $this->deserializer->deserialize(GPSCoordinates::class, $this->deserialized);
        $this->assertTrue($this->gps->equals($gps));
    }
}
