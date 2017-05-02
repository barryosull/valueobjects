<?php namespace EventSourced\ValueObject\ValueObject;

class NullableGPSCoordinates extends GPSCoordinates
{
    public function __construct(Coordinate $latitude=null, Coordinate $longitude=null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}

