<?php

namespace EventSourced\ValueObject\Test\ValueObject;

use EventSourced\ValueObject\ValueObject\Coordinate;
use EventSourced\ValueObject\Reflector\Reflector;

class TestSingleValue extends \PHPUnit_Framework_TestCase 
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

    public function test_serialize()
    {
        $value = 23.09232;
        $coordinate = new Coordinate($value);
        
        $this->assertEquals($value, $this->serializer->serialize($coordinate));
    }
    
    public function test_deserialize()
    {
        $value = 23.09232;
        $coordinate = $this->deserializer->deserialize(Coordinate::class, $value);
        
        $this->assertEquals($value, $this->serializer->serialize($coordinate));
    }
}

