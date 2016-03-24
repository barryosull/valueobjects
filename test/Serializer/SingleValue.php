<?php

namespace EventSourced\Test\ValueObject;

use EventSourced\ValueObject\Coordinate;
use EventSourced\Reflector\Reflector;

class TestSingleValue extends \PHPUnit_Framework_TestCase 
{
    private $serializer;
    private $deserializer;
    
    public function setUp()
    {
        $reflector = new Reflector();
        $this->serializer = new \EventSourced\Serializer\Serializer($reflector);
        $this->deserializer = new \EventSourced\Deserializer\Deserializer($reflector);
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

