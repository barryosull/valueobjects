<?php

use EventSourced\Assert;
use EventSourced\ValueObject\DateTime;
use EventSourced\ValueObject\Integer;

class TestDateTime extends \PHPUnit_Framework_TestCase 
{
    public function test_valid_value()
    {
        new DateTime("2013-01-01 12:12:12");
    }
    
    public function test_invalid_value()
    {
        $this->setExpectedException(Assert\IsException::class);
        new DateTime("2013-01-01 asdf");
    }
    
    public function test_add_seconds()
    {
        $date = new DateTime("2013-01-01 00:00:00");
        $new_date = $date->add_seconds( new Integer(3600));
        
        $this->assertTrue($new_date->equals( new DateTime("2013-01-01 01:00:00") ));
    }
    
    public function test_date_must_have_time()
    {
        $this->setExpectedException(Assert\IsException::class);
        new DateTime("2013-01-01");
    }
}