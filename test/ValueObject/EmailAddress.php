<?php

namespace EventSourced\ValueObject\Test\ValueObject;

use EventSourced\ValueObject\ValueObject\EmailAddress;

class TestEmailAddress extends \PHPUnit_Framework_TestCase 
{
    public function test_valid_address() 
    {
        new EmailAddress("test@email.com");
    }
    
    public function test_invalid_address()
    {
        $this->setExpectedException(\EventSourced\ValueObject\Assert\Exception::class);
        new EmailAddress("invalid@xfdsfsdf");
    }
}

