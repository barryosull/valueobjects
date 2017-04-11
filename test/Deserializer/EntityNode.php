<?php namespace Test\Deserializer;

use EventSourced\ValueObject\Extensions\ExtensionRepository;
use Test\Serializer\EntityNode\Vehicle;
use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Deserializer;
use EventSourced\ValueObject\ValueObject\Uuid;
use Test\Serializer\EntityNode\MaxSpeed;
use Test\Serializer\EntityNode\Type;

class EntityNode extends \PHPUnit_Framework_TestCase
{
    private $serializer;
    private $deserializer;
    private $car;

    private $deserialized_car= [
        'id' => '4f8c0cb1-bc3b-4d26-b7dd-4a7210c84d5e',
        'type' => 'car',
        'max_speed' => 150,
        'details' => [
            'wheels'=> 4,
            'seats'=>'leather'
        ]
    ];

    public function setUp()
    {
        $reflector = new Reflector();
        $extensions = new ExtensionRepository();
        $this->serializer = new \EventSourced\ValueObject\Serializer\Serializer($reflector, $extensions);
        $this->deserializer = new Deserializer\Deserializer($reflector, $extensions);

        $this->car = new Vehicle(
            new Uuid($this->deserialized_car['id']),
            new MaxSpeed(150),
            new Type('car'),
            new \Test\Serializer\EntityNode\Car(
                new \EventSourced\ValueObject\ValueObject\Integer(4),
                New \EventSourced\ValueObject\ValueObject\NotBlankString("leather")
            )
        );
    }

    public function test_can_deserialize_array()
    {
        $actual = $this->deserializer->deserialize(Vehicle::class, $this->deserialized_car);

        $this->assertEquals($this->car, $actual);
    }

    public function test_can_deserialize_object()
    {
        $object = json_decode(json_encode($this->deserialized_car));

        $actual = $this->deserializer->deserialize(Vehicle::class, $object);

        $this->assertEquals($this->car, $actual);
    }
}
