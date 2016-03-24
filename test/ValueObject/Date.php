<?php

use EventSourced\ValueObject\Assert;
use EventSourced\ValueObject\ValueObject\Date;

class TestDate extends \PHPUnit_Framework_TestCase 
{
    public function test_valid_value()
    {
        new Date("2013-01-01");
    }
    
    public function test_invalid_value()
    {
        $this->setExpectedException(Assert\IsException::class);
        new Date("2013-01as");
    }
    
    public function test_date_ignores_time()
    {
        $date = new Date("2013-01-01 00:00:00");
        $this->assertTrue($date->equals(new Date("2013-01-01 12:12:12")));
    }
}