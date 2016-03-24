<?php

use EventSourced\ValueObject\ValueObject\Integer;
use EventSourced\ValueObject\ValueObject\IntegerCollection;
use EventSourced\ValueObject\Reflector\Reflector;

class TestCollection extends \PHPUnit_Framework_TestCase 
{
    private $serializer;
    private $deserializer;
    
    public function setUp()
    {
        $reflector = new Reflector();
        $this->serializer = new \EventSourced\ValueObject\Serializer\Serializer($reflector);
        $this->deserializer = new \EventSourced\ValueObject\Deserializer\Deserializer($reflector);
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
        $deserialized = $this->deserializer->deserialize(IntegerCollection::class, $serialized);
        $this->assertTrue($collection->equals($deserialized));
    }
}