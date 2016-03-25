<?php

namespace EventSourced\ValueObject\ValueObject;

class GPSCoordinates extends Type\AbstractComposite 
{   
    protected $latitude;
    protected $longitude;
    
    public function __construct(Coordinate $latitude, Coordinate $longitude) 
	{
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
    
    public function latitude()
    {
        return $this->latitude;
    }
    
    public function longitude()
    {
        return $this->longitude;
    }
}
