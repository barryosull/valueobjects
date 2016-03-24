<?php

use EventSourced\ValueObject\Assert;
use EventSourced\ValueObject\ValueObject\Integer;
use EventSourced\ValueObject\ValueObject\IntegerTreeNode;

class TestIntegerTreeNode extends \PHPUnit_Framework_TestCase 
{
    public function test_accepts_integer()
    {
        return new IntegerTreeNode(new Integer(5));
    }
    
    public function test_accepts_integer_collection()
    {
        $collection = new \EventSourced\ValueObject\ValueObject\IntegerCollection([
            new Integer(5)
        ]);
        return new IntegerTreeNode($collection);
    }
    
    public function test_wont_accept_email_address()
    {
        $this->setExpectedException(Assert\IsException::class);
        new IntegerTreeNode( 
            new EventSourced\ValueObject\ValueObject\EmailAddress("dfasfd@sdfsdf.com")
        );
    }
    
    public function test_equals()
    {
        $integer = $this->test_accepts_integer();
        $collection = $this->test_accepts_integer_collection();
        
        $this->assertFalse($integer->equals($collection));
        $this->assertTrue($integer->equals($this->test_accepts_integer()));
    }
    
    public function test_access_value()
    {
        $node = new IntegerTreeNode(new Integer(5));
        $this->assertTrue($node->value()->equals(new Integer(5)));
    }
}