<?php

use EventSourced\ValueObject\Assert;
use EventSourced\ValueObject\ValueObject\Integer;
use EventSourced\ValueObject\ValueObject\IntegerCollection;

class TestIntegerCollection extends \PHPUnit_Framework_TestCase 
{    
    private $collection;
    
    public function setUp()
    {
        $this->collection = new IntegerCollection([new Integer(5), new Integer(7)]);
    }
    
    public function test_invalid_type()
    {
        $this->setExpectedException(Assert\IsException::class);
        new IntegerCollection(["sadsasdasd", "sdfsdfsdf"]);
    }
    
    public function test_remove()
    {
        $collection = $this->collection->remove(new Integer(7));        
        $expected = new IntegerCollection([new Integer(5)]);
        
        $this->assertTrue($collection->equals($expected));
    }
    
    public function test_get_index()
    {
        $this->assertTrue($this->collection->get(0)->equals(new Integer(5)));
    }
    
    public function test_fail_to_get_by_index()
    {
        $this->setExpectedException(\Exception::class);
        $this->collection->get(2);
    }
}