<?php

namespace EventSourced\Test\ValueObject;

use EventSourced\ValueObject\GPSCoordinates;
use EventSourced\ValueObject\Coordinate;
use EventSourced\Reflector\Reflector;

class TestComposite extends \PHPUnit_Framework_TestCase 
{
    private $gps;
    private $deserialized = ['latitude'=>23.9, 'longitude'=>90.0];
    private $serializer;
    private $deserializer;
    
    public function setUp()
    {
        $reflector = new Reflector();
        $this->serializer = new \EventSourced\Serializer\Serializer($reflector);
        $this->deserializer = new \EventSourced\Deserializer\Deserializer($reflector);
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
    