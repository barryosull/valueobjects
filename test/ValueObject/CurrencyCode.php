<?php

use EventSourced\ValueObject\Assert;
use EventSourced\ValueObject\ValueObject\CurrencyCode;

class TestCurrencyCode extends \PHPUnit_Framework_TestCase 
{
    public function test_valid_value()
    {
        new CurrencyCode("EUR");
    }
    
    public function test_invalid_value()
    {
        $this->setExpectedException(Assert\Exception::class);
        new CurrencyCode("WWW");
    }
}