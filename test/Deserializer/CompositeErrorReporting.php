<?php

use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Deserializer;
use EventSourced\ValueObject\ValueObject\SampleEntity;

class TestCompositeErrorReporting extends \PHPUnit_Framework_TestCase
{
    private $deserializer;

    public function setUp()
    {
        $reflector = new Reflector();
        $this->deserializer = new Deserializer\Deserializer($reflector);
        parent::setUp();
    }

    public function test_returns_human_readable_error()
    {
        $encoded = [
          "id"=> "1234",
          "date"=> "saads"
        ];

        $exception = new \Exception();
        try {
            $this->deserializer->deserialize(SampleEntity::class, $encoded);
        } catch (\DomainException $e) {
            $exception = $e;
        }

        $expected = [
            "id" => ['"1234" must validate against "/([a-f\\\\d]{8}(-[a-f\\\\d]{4}){3}-[a-f\\\\d]{12}?)/i"'],
            "date" => ['"saads" must be a valid date']
        ];

        $this->assertEquals($expected, $exception->error_messages());
    }
}