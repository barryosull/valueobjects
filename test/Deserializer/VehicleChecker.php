<?php namespace Test\Deserializer;

use Test\Serializer\EntityNode\Vehicle;

class VehicleChecker
{
    public function acceptAndReturnVehicle(Vehicle $vehicle)
    {
        return $vehicle;
    }
}