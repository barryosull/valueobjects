<?php

use EventSourced\Assert;
use EventSourced\ValueObject\CurrencyCode;

class TestCurrencyCode extends \PHPUnit_Framework_TestCase 
{
    public function test_valid_value()
    {
        new CurrencyCode("EUR");
    }
    
    public function test_invalid_value()
    {
        $this->setExpectedException(Assert\IsException::class);
        new CurrencyCode("WWW");
    }
}