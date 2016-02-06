<?php

namespace EventSourced\Test\ValueObject;

use EventSourced\ValueObject\GPSCoordinates;
use EventSourced\ValueObject\Coordinate;

class TestGPSCoordinates extends \PHPUnit_Framework_TestCase 
{
    private $gps;
    private $deserialized = ['latitude'=>23.9, 'longitude'=>90.0];
    
    public function setUp()
    {
        $this->gps = new GPSCoordinates(new Coordinate(23.9),  new Coordinate(90.0));
        parent::setUp();
    }
    
    public function test_serialize()
    {
        $this->assertEquals($this->gps->serialize(), $this->deserialized);
    }
    
    public function test_deserialize()
    {
        $gps = GPSCoordinates::deserialize($this->deserialized);
        $this->assertTrue($this->gps->equals($gps));
    }
    
    public function test_equals()
    {
        $gps = new GPSCoordinates(new Coordinate(23.9),  new Coordinate(83.0));
        $this->assertFalse($this->gps->equals($gps));
    }
}
    