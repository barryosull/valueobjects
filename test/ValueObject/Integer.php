<?php

use EventSourced\Assert;
use EventSourced\ValueObject\Integer;

class TestInteger extends \PHPUnit_Framework_TestCase 
{
    public function test_valid_value()
    {
        new Integer(5);
    }
    
    public function test_empty_value()
    {
        $this->setExpectedException(Assert\IsException::class);
        new Integer(null);
    }
    
    public function test_string_value()
    {
        $this->setExpectedException(Assert\IsException::class);
        new Integer("asdfasdf");
    }
    
    public function test_float_value()
    {
        $this->setExpectedException(Assert\IsException::class);
        new Integer(12132.2132);
    }
    
    public function test_access_value()
    {
        $integer = new Integer(5);
        $this->assertEquals(5, $integer->value());
    }
}