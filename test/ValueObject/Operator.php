<?php

use EventSourced\ValueObject\ValueObject\Operator;

class TestOperator extends \PHPUnit_Framework_TestCase {
    
    public function test_valid()
    {
        new Operator('>');
        new Operator('<');
        new Operator('equals');
        new Operator('is');
        new Operator('or');
        new Operator('and');
    }
    
    public function test_invalid()
    {
        $this->setExpectedException(\EventSourced\ValueObject\Assert\Exception::class);
        new Operator('asd');
    }
    
    public function test_invalid_blank()
    {
        $this->setExpectedException(\EventSourced\ValueObject\Assert\Exception::class);
        new Operator('');
    }
}

