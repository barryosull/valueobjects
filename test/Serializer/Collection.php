<?php

use EventSourced\ValueObject\Integer;
use EventSourced\ValueObject\IntegerCollection;

class TestCollection extends \PHPUnit_Framework_TestCase 
{
    private $serializer;
    
    public function setUp()
    {
        $this->serializer = new \EventSourced\Serializer\Serializer();
        parent::setUp();
    }

    public function collection()
    {
        return new IntegerCollection([new Integer(5), new Integer(7)]);
    }

    public function test_serialize() 
    {
        $serialized = $this->serializer->serialize($this->collection());
        $this->assertEquals([5,7], $serialized);
    }
    
    public function test_deserialize()
    {
        $collection = $this->collection();
        $serialized = $this->serializer->serialize($this->collection());
        $deserialized = $this->serializer->deserialize(IntegerCollection::class, $serialized);
        $this->assertTrue($collection->equals($deserialized));
    }
}