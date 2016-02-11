<?php

use EventSourced\Assert;
use EventSourced\ValueObject\Integer;
use EventSourced\ValueObject\AscendingIntegerCollection;

class TestIntegerSequence extends \PHPUnit_Framework_TestCase 
{
    public function test_valid_value()
    {
        return new AscendingIntegerCollection([new Integer(5), new Integer(5), new Integer(7)]);
    }
    
    public function test_invalid_sequence()
    {
        $this->setExpectedException(Assert\IsException::class);
        new AscendingIntegerCollection([new Integer(7), new Integer(3)]);
    }
}