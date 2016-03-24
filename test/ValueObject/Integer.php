<?php

use EventSourced\ValueObject\Assert;
use EventSourced\ValueObject\ValueObject\Integer;

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
    
    public function test_add()
    {
        $int_a = new Integer(5);
        $int_b = new Integer(3);
        $this->assertTrue($int_a->add($int_b)->equals(new Integer(8)));
    }
    
    public function test_subtract()
    {
        $int_a = new Integer(5);
        $int_b = new Integer(3);
        $this->assertTrue($int_a->subtract($int_b)->equals(new Integer(2)));
    }
    
    public function test_reset()
    {
        $int = new Integer(5);
        $this->assertTrue($int->reset()->equals(new Integer(0)));
    }
}