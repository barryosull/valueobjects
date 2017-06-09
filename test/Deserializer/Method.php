<?php namespace Test\Deserializer;

use EventSourced\ValueObject\Contracts\MethodDeserializer;
use EventSourced\ValueObject\Extensions\ExtensionRepository;
use Test\Serializer\EntityNode\Vehicle;
use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Deserializer;
use EventSourced\ValueObject\ValueObject\Uuid;
use Test\Serializer\EntityNode\MaxSpeed;
use Test\Serializer\EntityNode\Type;

class Method extends \PHPUnit_Framework_TestCase
{
    private $serializer;

    /** @var  MethodDeserializer */
    private $deserializer;
    private $car;

    private $serialized_method_argument= [
        'vehicle' => [
            'id' => '4f8c0cb1-bc3b-4d26-b7dd-4a7210c84d5e',
            'type' => 'car',
            'max_speed' => 150,
            'details' => [
                'wheels'=> 4,
                'seats'=>'leather'
            ]
        ]
    ];

    public function setUp()
    {
        $reflector = new Reflector();
        $extensions = new ExtensionRepository();
        $this->serializer = new \EventSourced\ValueObject\Serializer\Serializer($reflector, $extensions);
        $this->deserializer = new Deserializer\Deserializer($reflector, $extensions);

        $this->car = new Vehicle(
            new Uuid($this->serialized_method_argument['vehicle']['id']),
            new MaxSpeed(150),
            new Type('car'),
            new \Test\Serializer\EntityNode\Car(
                new \EventSourced\ValueObject\ValueObject\Integer(4),
                New \EventSourced\ValueObject\ValueObject\NotBlankString("leather")
            )
        );
    }

    public function test_deserialize_into_method()
    {
        $vehicle_checker = new VehicleChecker();

        $method = $this->deserializer->deserializeMethod($vehicle_checker, "acceptAndReturnVehicle", $this->serialized_method_argument);
        $this->assertEquals($this->car, $method->run());
    }
}
