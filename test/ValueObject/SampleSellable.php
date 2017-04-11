<?php

use EventSourced\ValueObject\Deserializer\Deserializer;
use EventSourced\ValueObject\Deserializer\Exception;
use EventSourced\ValueObject\Extensions\ExtensionRepository;
use EventSourced\ValueObject\Reflector\Reflector;
use EventSourced\ValueObject\Serializer\Serializer;
use EventSourced\ValueObject\ValueObject\NotBlankString;
use EventSourced\ValueObject\ValueObject\SampleSellable;
use Money\Currency;
use Money\Money;

class SampleSellableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var Deserializer
     */
    private $deserializer;

    protected function setUp()
    {
        parent::setUp();
        
        $reflector = new Reflector();
        $extensions = new ExtensionRepository();
        $this->serializer = new Serializer($reflector, $extensions);
        $this->deserializer = new Deserializer($reflector, $extensions);
    }

    public function test_create_sellable_item()
    {
        $book = new SampleSellable(
            new NotBlankString("Adventures"),
            new Money("15", new Currency('EUR'))
        );

        $this->assertInstanceOf(SampleSellable::class, $book);
    }

    public function test_serialize_sellable()
    {
        $book = new SampleSellable(
            new NotBlankString("Adventures"),
            new Money("15", new Currency('EUR'))
        );

        $expected = [
            'name' => 'Adventures',
            'price' => [
                'amount' => '15',
                'currency' => 'EUR'
            ]
        ];

        $serialized = $this->serializer->serialize($book);
        $this->assertInternalType('array', $serialized);
        $this->assertEquals($expected, $serialized);
    }

    public function test_deserialize_sellable()
    {
        $serialized = [
            'name' => 'Adventures',
            'price' => [
                'amount' => '15',
                'currency' => 'EUR'
            ]
        ];

        $book = $this->deserializer->deserialize(SampleSellable::class, $serialized);
        $this->assertInstanceOf(SampleSellable::class, $book);
    }

    public function test_exception_should_be_thrown()
    {
        $this->expectException(Exception::class);
        
        $serialized = [
            'name' => 'Adventures',
            'price' => [
                'amount' => '15',
                'currency' => null
            ]
        ];

        $this->deserializer->deserialize(SampleSellable::class, $serialized);
    }
}
