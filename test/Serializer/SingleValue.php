<?php

namespace EventSourced\Test\ValueObject;

use EventSourced\ValueObject\Coordinate;

class TestSingleValue extends \PHPUnit_Framework_TestCase 
{
    private $serializer;
    
    public function setUp()
    {
        $this->serializer = new \EventSourced\Serializer\Serializer();
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
        $coordinate = $this->serializer->deserialize(Coordinate::class, $value);
        
        $this->assertEquals($value, $this->serializer->serialize($coordinate));
    }
}

