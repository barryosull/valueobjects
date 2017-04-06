<?php

use EventSourced\ValueObject\ValueObject\Integer;
use EventSourced\ValueObject\ValueObject\IntegerCollection;
use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Deserializer;

class TestCollection extends \PHPUnit_Framework_TestCase 
{
    private $serializer;
    private $deserializer;
    
    public function setUp()
    {
        $reflector = new Reflector();
        $extensions = new \EventSourced\ValueObject\Extensions\ExtensionRepository();
        $this->serializer = new \EventSourced\ValueObject\Serializer\Serializer($reflector, $extensions);
        $this->deserializer = new Deserializer\Deserializer($reflector, $extensions);
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

    public function test_deserialize_error_reporting()
    {
        $serialized = [36, "asdf"];
        $exception = new \Exception();
        try {
            $this->deserializer->deserialize(IntegerCollection::class, $serialized);
        }catch (Deserializer\Exception $e) {
            $exception = $e;
        }

        $expected = [
            1 => ['"asdf" must be an integer number']
        ];

        $this->assertEquals($expected, $exception->error_messages());
    }
}
