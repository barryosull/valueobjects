<?php

namespace EventSourced\ValueObject;

class GPSCoordinates extends AbstractComposite 
{    
    private $latitude;
    private $longitude;
    
    public function __construct(Coordinate $latitude, Coordinate $longitude) 
	{
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}
