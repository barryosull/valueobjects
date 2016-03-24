<?php

namespace EventSourced\ValueObject;

class GPSCoordinates extends Type\AbstractComposite 
{   
    private $latitude;
    private $longitude;
    
    public function __construct(Coordinate $latitude, Coordinate $longitude) 
	{
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        parent::__construct($latitude, $longitude);
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
