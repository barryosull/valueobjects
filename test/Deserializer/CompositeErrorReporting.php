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

    public function test_reporting_when_values_are_wrong()
    {
        $encoded = [
            "id" => "1234",
            "date" => "saads"
        ];

        $exception = $this->fail_elegantly($encoded);

        $expected = [
            "id" => ['"1234" must validate against "/([a-f\\\\d]{8}(-[a-f\\\\d]{4}){3}-[a-f\\\\d]{12}?)/i"'],
            "date" => ['"saads" must be a valid date']
        ];

        $this->assertEquals($expected, $exception->error_messages());
    }

    private function fail_elegantly($encoded)
    {
        try {
            $this->deserializer->deserialize(SampleEntity::class, $encoded);
        } catch (Deserializer\Exception $e) {
            return $e;
        }
        throw new \Exception("This function should have thrown an exception.");
    }

    public function test_reporting_when_values_are_missing()
    {
        $encoded = [
            "date"=> "2014-01-01"
        ];

        $exception = $this->fail_elegantly($encoded);

        $expected = [
            "id" => ["Property 'id' is missing"]
        ];

        $this->assertEquals($expected, $exception->error_messages());
    }
}