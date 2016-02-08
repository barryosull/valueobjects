<?php

namespace EventSourced\Test\ValueObject;

use EventSourced\ValueObject\Coordinate;

class TestCoordinate extends \PHPUnit_Framework_TestCase 
{
    public function test_valid_coordinate() 
    {
        new Coordinate(23.09232);
        new Coordinate(90.000);
        new Coordinate(-89.0923232);
        new Coordinate(-90);
    }
    
    public function test_parsing_strings()
    {
        new Coordinate("89.000");
    }
    
    public function test_over_max_range() 
    {
        $this->setExpectedException(\EventSourced\AssertIsException::class);
        new Coordinate(90.00001);
    }
    
    public function test_under_min_range() 
    {
        $this->setExpectedException(\EventSourced\AssertIsException::class);
        new Coordinate(-90.00001);
    }
    
    public function test_serialize()
    {
        $value = 23.09232;
        $coordinate = new Coordinate($value);
        
        $this->assertEquals($value, $coordinate->serialize());
    }
    
    public function test_deserialize()
    {
        $value = 23.09232;
        $coordinate = Coordinate::deserialize($value);
        
        $this->assertEquals($value, $coordinate->serialize());
    }
    
    public function test_equals()
    {
        $coordinate_a = new Coordinate(23.22);
        $coordinate_b = new Coordinate(23.22);
        $coordinate_c = new Coordinate(54.11);
        
        $this->assertTrue($coordinate_a->equals($coordinate_b));
        $this->assertFalse($coordinate_a->equals($coordinate_c));
    }
}

