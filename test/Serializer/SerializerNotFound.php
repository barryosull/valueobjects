<?php

use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Serializer;
use EventSourced\ValueObject\ValueObject\Uuid;

class TestSerializerNotFound extends \PHPUnit_Framework_TestCase
{
    private $serializer;

    public function setUp()
    {
        $reflector = new Reflector();
        $extensions = new \EventSourced\ValueObject\Extensions\ExtensionRepository();
        $this->serializer = new Serializer\Serializer($reflector, $extensions);
        parent::setUp();
    }

    public function test_fails_if_not_valid_vo_type()
    {
        $this->setExpectedException(Serializer\Exception::class, "No serializer found for class 'stdClass'");
        $this->serializer->serialize(new \stdClass());
    }

    public function test_fails_if_VO_property_is_blank()
    {
        $this->setExpectedException(Serializer\Exception::class, "Property 'no_value' is null, cannot encode. Please check a value is assigned in the constructor.");
        $VO = new \Test\Serializer\BlankPropertyVO( Uuid::generate());
        $this->serializer->serialize($VO);
    }
}
