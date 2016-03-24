<?php

use EventSourced\ValueObject\Assert;
use EventSourced\ValueObject\ValueObject\Boolean;

class TestBoolean extends \PHPUnit_Framework_TestCase 
{
    public function test_valid_value()
    {
        new Boolean(true);
        new Boolean(false);
    }
    
    public function test_empty_value()
    {
        $this->setExpectedException(Assert\IsException::class);
        new Boolean(0);
    }
    
    public function test_string_value()
    {
        $this->setExpectedException(Assert\IsException::class);
        new Boolean("asdfasdf");
    }
    
    public function test_float_value()
    {
        $this->setExpectedException(Assert\IsException::class);
        new Boolean(12132.2132);
    }
    
    public function test_access_value()
    {
        $bool = new Boolean(true);
        $this->assertTrue($bool->value());
    }
    
    public function test_true()
    {
        $bool = new Boolean(true);
        $this->assertTrue($bool->true());
        $this->assertFalse($bool->false());
    }
    
    public function test_false()
    {
        $bool = new Boolean(false);
        $this->assertTrue($bool->false());
        $this->assertFalse($bool->true());
    }
}