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
        $this->setExpectedException("Exception");
        new Coordinate(90.00001);
    }
    
    public function test_under_min_range() 
    {
        $this->setExpectedException("Exception");
        new Coordinate(-90.00001);
    }
}

