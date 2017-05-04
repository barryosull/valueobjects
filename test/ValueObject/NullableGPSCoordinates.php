<?php namespace EventSourced\ValueObject\Test\ValueObject;

use EventSourced\ValueObject\ValueObject\NullableGPSCoordinates;
use EventSourced\ValueObject\ValueObject\Coordinate;

class TestNullableGPSCoordinates extends \PHPUnit_Framework_TestCase
{
    private $gps;

    public function setUp()
    {
        $this->gps = new NullableGPSCoordinates();
        parent::setUp();
    }

    public function test_is_null_when_null()
    {
        $gps = new NullableGPSCoordinates();
        $this->assertTrue($gps->is_null());
    }

    public function test_is_null_when_not_not_null()
    {
        $gps = new NullableGPSCoordinates(new Coordinate(23.9),  new Coordinate(83.0));
        $this->assertFalse($gps->is_null());
    }
}
