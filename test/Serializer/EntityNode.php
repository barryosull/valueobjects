<?php

use Test\Serializer\EntityNode\Vehicle;
use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Deserializer;

class EntityNode extends \PHPUnit_Framework_TestCase
{
    private $serializer;
    private $deserializer;
    private $car;
    private $bike;

    private $deserialized_car= [
        'id' => '4f8c0cb1-bc3b-4d26-b7dd-4a7210c84d5e',
        'type' => 'car',
        'max_speed' => 150,
        'details' => [
            'wheels'=> 4,
            'seats'=>'leather'
        ]
    ];

    private $deserialized_bike = [
        'id' => '5e8e4208-3014-4df0-842a-f318f533f358',
        'type' => 'bike',
        'max_speed' => 30,
        'details' => [
            'lights'=> 4,
            'saddle'=>'leather'
        ]
    ];

    public function setUp()
    {
        $reflector = new Reflector();
        $extensions = new \EventSourced\ValueObject\Extensions\ExtensionRepository();
        $this->serializer = new \EventSourced\ValueObject\Serializer\Serializer($reflector, $extensions);
        $this->deserializer = new Deserializer\Deserializer($reflector, $extensions);

        $this->car = $this->deserializer->deserialize(Vehicle::class, $this->deserialized_car);

        $this->bike = $this->deserializer->deserialize(Vehicle::class, $this->deserialized_bike);
    }

    public function test_serialize_car()
    {
        $this->assertEquals($this->deserialized_car, $this->serializer->serialize($this->car));
    }

    public function test_serialize_bike()
    {
        $this->assertEquals($this->deserialized_bike, $this->serializer->serialize($this->bike));
    }

    public function test_fails_if_the_type_does_not_match_the_shape()
    {
        $deserialized_invalid_car = $this->deserialized_car;
        $deserialized_invalid_car['details'] = $this->deserialized_bike['details'];

        $exception = new \Exception();
        try {
            $this->deserializer->deserialize(Vehicle::class, $deserialized_invalid_car);
        }catch (Deserializer\Exception $e) {
            $exception = $e;
        }

        $expected = [
            'details' => [
                'wheels' => ["Property 'wheels' is missing"],
                'seats' => ["Property 'seats' is missing"]
            ]
        ];

        $this->assertEquals($expected, $exception->error_messages());
    }
}
