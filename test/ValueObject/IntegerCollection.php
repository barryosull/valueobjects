<?php

use EventSourced\Assert;
use EventSourced\ValueObject\Integer;
use EventSourced\ValueObject\Float;
use EventSourced\ValueObject\IntegerCollection;

class TestIntegerCollection extends \PHPUnit_Framework_TestCase 
{
    public function test_valid_value()
    {
        return new IntegerCollection([new Integer(5), new Integer(7)]);
    }
    
    public function test_invalid_type()
    {
        $this->setExpectedException(Assert\IsException::class);
        new IntegerCollection(["sadsasdasd", "sdfsdfsdf"]);
    }
    
    public function test_float_value()
    {
        $this->setExpectedException(Assert\IsException::class);
        new IntegerCollection([new Float(0.2132)]);
    }
    
    public function test_serialize() 
    {
        $seralized = $this->test_valid_value()->serialize();
        $this->assertEquals([5,7], $seralized);
    }
    
    public function test_deserialize()
    {
        $collection = $this->test_valid_value();
        $deserialized = IntegerCollection::deserialize($collection->serialize());
        $this->assertTrue($collection->equals($deserialized));
    }
    
    public function test_remove()
    {
        $collection = $this->test_valid_value()->remove(new Integer(7));        
        $expected = new IntegerCollection([new Integer(5)]);
        
        $this->assertTrue($collection->equals($expected));
    }
}