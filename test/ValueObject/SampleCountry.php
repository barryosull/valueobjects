<?php

use EventSourced\ValueObject\Deserializer\Deserializer;
use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Serializer\Serializer;
use EventSourced\ValueObject\ValueObject\NotBlankString;
use EventSourced\ValueObject\ValueObject\SampleCountry;
use Money\Currency;

class SampleCountryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var Deserializer
     */
    private $deserializer;

    public function setUp()
    {
        parent::setUp();

        $reflector = new Reflector();
        $this->serializer = new Serializer($reflector);
        $this->deserializer = new Deserializer($reflector);
    }

    public function test_serialize_country()
    {
        $country = new SampleCountry(
            new NotBlankString("Ireland"),
            new Currency("EUR")
        );

        $expected = [
            'name' => 'Ireland',
            'currency' => 'EUR'
        ];

        $serialized = $this->serializer->serialize($country);
        $this->assertInternalType('array', $serialized);
        $this->assertEquals($expected, $serialized);
    }

    public function test_deserialize_country()
    {
        $serialized = [
            'name' => 'Ireland',
            'currency' => 'EUR'
        ];

        $country = $this->deserializer->deserialize(SampleCountry::class, $serialized);
        $this->assertInstanceOf(Samplecountry::class, $country);
    }
}
