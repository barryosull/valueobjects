<?php

use EventSourced\Assert;
use EventSourced\ValueObject\UUID;

class TestUUID extends \PHPUnit_Framework_TestCase 
{
    public function test_valid_value()
    {
        new UUID("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8");
    }
    
    public function test_invalid_value()
    {
        $this->setExpectedException(Assert\IsException::class);
        new UUID("asdfasdf");
    }
}