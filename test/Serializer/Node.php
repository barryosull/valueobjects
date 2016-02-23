<?php

use EventSourced\ValueObject\Integer;
use EventSourced\ValueObject\IntegerCollection;
use EventSourced\ValueObject\IntegerTreeNode;

class TestTreeNode extends \PHPUnit_Framework_TestCase 
{    
    private $serializer;
    private $integer;
    private $collection;
    
    private $deserialized_collection = [
        'type' => 'integerCollection',
        'value' => [5]
    ];
    
    private $deserialized_integer = [
        'type' => 'integer',
        'value' => 5
    ];
    
    public function setUp()
    {
        $this->serializer = new \EventSourced\Serializer\Serializer();
        
        $value1 = new Integer(5);
        $this->integer = new IntegerTreeNode($value1);
        
        $value2 = new IntegerCollection([$value1]);
        $this->collection = new IntegerTreeNode($value2);
    }
        
    public function test_serialize_collection()
    {
        $this->assertEquals($this->deserialized_collection, $this->serializer->serialize($this->collection));
    }
    
    public function test_deserialize_collection()
    {
        $collection = $this->serializer->deserialize(IntegerTreeNode::class, $this->deserialized_collection);
        $this->assertTrue($this->collection->equals($collection));
    }

    public function test_deserialize_integer()
    {
        $integer = $this->serializer->deserialize(IntegerTreeNode::class, $this->deserialized_integer);
        $this->assertTrue($this->integer->equals($integer));
    }
}

