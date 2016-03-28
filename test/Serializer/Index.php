<?php

use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Serializer\Serializer;
use EventSourced\ValueObject\Deserializer\Deserializer;
use EventSourced\ValueObject\ValueObject\Uuid;
use EventSourced\ValueObject\ValueObject\Date;
use EventSourced\ValueObject\ValueObject\SampleEntity;
use EventSourced\ValueObject\ValueObject\SampleEntityIndex;

class TestIndex extends \PHPUnit_Framework_TestCase 
{
    private $serializer;
    private $deserializer;
    
    public function setUp()
    {
        $reflector = new Reflector();
        $this->serializer = new Serializer($reflector);
        $this->deserializer = new Deserializer($reflector);
        parent::setUp();
    }

    public function collection()
    {
        $entity = new SampleEntity(new Uuid("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8"), new Date('2012-01-20'));
        return new SampleEntityIndex([$entity]);
    }

    public function test_serialize() 
    {
        $expected_serialized = [
            [
                'id' => "ac9e4e83-5495-4a58-90d9-eeeaf3989bc8",
                'date' => "2012-01-20"
            ]
        ];
        $serialized = $this->serializer->serialize($this->collection());
        $this->assertEquals($expected_serialized, $serialized);
    }
    
    public function test_deserialize()
    {
        $collection = $this->collection();
        $serialized = $this->serializer->serialize($this->collection());
        $deserialized = $this->deserializer->deserialize(SampleEntityIndex::class, $serialized);
        $this->assertTrue($collection->equals($deserialized));
    }
}