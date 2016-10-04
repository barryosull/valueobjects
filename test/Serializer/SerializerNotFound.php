<?php

use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Serializer;

class SerializerNotFound extends \PHPUnit_Framework_TestCase
{
    private $serializer;

    public function setUp()
    {
        $reflector = new Reflector();
        $this->serializer = new Serializer\Serializer($reflector);
        parent::setUp();
    }

    public function test_fails_if_not_valid_vo_type()
    {
        $this->setExpectedException(Serializer\Exception::class);
        $this->serializer->serialize(new \stdClass());
    }
}