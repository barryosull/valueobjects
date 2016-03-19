<?php

namespace EventSourced\Test\ValueObject;

use EventSourced\ValueObject\GPSCoordinates;
use EventSourced\ValueObject\Coordinate;

class TestGPSCoordinates extends \PHPUnit_Framework_TestCase 
{
    private $latitude;
    private $longitude;
    private $gps;
    
    public function setUp()
    {
        $this->latitude = new Coordinate(23.9); 
        $this->longitude = new Coordinate(90.0);
        $this->gps = new GPSCoordinates($this->latitude,  $this->longitude);
        parent::setUp();
    }
       
    public function test_equals()
    {
        $gps = new GPSCoordinates(new Coordinate(23.9),  new Coordinate(83.0));
        $this->assertFalse($this->gps->equals($gps));
    }
    
    public function test_property_accessors()
    {
        $this->assertTrue($this->latitude->equals($this->gps->latitude()));
        $this->assertTrue($this->longitude->equals($this->gps->longitude()));
    }
}
    