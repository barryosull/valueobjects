<?php

namespace EventSourced\Test\ValueObject;

use EventSourced\ValueObject\Temperature;
use EventSourced\ValueObject\TemperatureScale;
use EventSourced\ValueObject\Float;
use EventSourced\Assert;

class TestTemperature extends \PHPUnit_Framework_TestCase 
{
    public function test_valid()
    {
        new Temperature( new TemperatureScale('c'), new Float(45) );
    }
    
    public function test_invalid_celsius()
    {
        $this->setExpectedException(Assert\IsException::class);
        new Temperature( new TemperatureScale('c'), new Float(104) );
    }
    
    public function test_invalid_fahrenheit()
    {
        $this->setExpectedException(Assert\IsException::class);
        new Temperature( new TemperatureScale('f'), new Float(-204) );
    }
}
    