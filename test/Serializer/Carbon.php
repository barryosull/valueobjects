<?php

use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Deserializer;

class Carbon extends \PHPUnit_Framework_TestCase
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

    const DATE_STRING = "2012-12-21 00:00:00";

    public function test_serialize()
    {
        $date = new \Carbon\Carbon(self::DATE_STRING);

        $value = $this->serializer->serialize($date);

        $this->assertEquals(self::DATE_STRING, $value);
    }

    public function test_deserialize()
    {
        $expected = new \Carbon\Carbon(self::DATE_STRING);

        $deserialized = $this->deserializer->deserialize(\Carbon\Carbon::class, self::DATE_STRING);

        $this->assertEquals($expected, $deserialized);
    }
}