<?php

namespace EventSourced\ValueObject;

class GPSCoordinates extends AbstractComposite 
{    
    public function __construct(Coordinate $latitude, Coordinate $longitude) 
	{
        $this->values['latitude'] = $latitude;
        $this->values['longitude'] = $longitude;
    }
}
