<?php

namespace EventSourced\Test\ValueObject;

use EventSourced\ValueObject\Coordinate;
use EventSourced\Assert;

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
        $this->setExpectedException(\EventSourced\Assert\IsException::class);
        new Coordinate(90.00001);
    }
    
    public function test_error_exception_shape()
    {
        $exception = new \Exception();
        try {
            new Coordinate(90.00001);
        } catch (Assert\IsException $ex) {
            $exception = $ex;
        }
        
        $this->assertEquals(90.00001, $exception->value());
        $this->assertEquals(Coordinate::class, $exception->valueobject_class());
    }
    
    public function test_under_min_range() 
    {
        $this->setExpectedException(\EventSourced\Assert\IsException::class);
        new Coordinate(-90.00001);
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

