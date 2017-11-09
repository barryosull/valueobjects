<?php

namespace Test\Deserializer;

use EventSourced\ValueObject\Extensions\ExtensionRepository;
use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Deserializer;
use EventSourced\ValueObject\Serializer\Serializer;
use EventSourced\ValueObject\ValueObject\Coordinate;
use EventSourced\ValueObject\ValueObject\GPSCoordinates;
use EventSourced\ValueObject\ValueObject\SampleCompositeWithVariableType;
use EventSourced\ValueObject\ValueObject\SampleType;
use EventSourced\ValueObject\ValueObject\Uuid;

class AbstractTypeObjectDeserializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var Deserializer\Deserializer
     */
    protected $deserializer;

    protected function setUp()
    {
        parent::setUp();

        $reflector = new Reflector();
        $extensions = new ExtensionRepository();
        $this->serializer = new Serializer($reflector, $extensions);
        $this->deserializer = new Deserializer\Deserializer($reflector, $extensions);
    }

    public function test_should_deserialize_sample_composite_with_variable_type()
    {
        $sample = [
            'type' => 'default',
            'value' => '95f2f496-38d4-4914-9632-9b1d803866ee'
        ];

        $sample = $this->deserializer->deserialize(
            SampleCompositeWithVariableType::class,
            $sample
        );

        $this->assertInstanceOf(SampleCompositeWithVariableType::class, $sample);

        $sample2 = [
            'type' => 'coordinates',
            'value' => [
                'latitude' => 23,
                'longitude' => 78
            ]
        ];

        $sample2 = $this->deserializer->deserialize(
            SampleCompositeWithVariableType::class,
            $sample2
        );

        $this->assertInstanceOf(SampleCompositeWithVariableType::class, $sample2);
    }

    public function test_should_serializer_sample_composite_with_variable_type()
    {
        $sample = new SampleCompositeWithVariableType(
            new SampleType('coordinates'),
            new GPSCoordinates(new Coordinate(23), new Coordinate(78))
        );

        $expected = [
            'type' => 'coordinates',
            'value' => [
                'latitude' => 23,
                'longitude' => 78
            ]
        ];

        $serialized = $this->serializer->serialize($sample);

        $this->assertEquals($expected, $serialized);

        $sample2 = new SampleCompositeWithVariableType(
            new SampleType('coordinates'),
            new Uuid('a71fdd68-ea34-4f3e-a2ea-72da87ceb262')
        );

        $expected2 = [
            'type' => 'coordinates',
            'value' => 'a71fdd68-ea34-4f3e-a2ea-72da87ceb262'
        ];

        $serialized2 = $this->serializer->serialize($sample2);

        $this->assertEquals($expected2, $serialized2);
    }
}