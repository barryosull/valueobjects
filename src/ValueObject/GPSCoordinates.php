<?php

namespace EventSourced\ValueObject;

class GPSCoordinates extends AbstractComposite 
{   
    public function __construct(Coordinate $latitude, Coordinate $longitude) 
	{
        parent::__construct($latitude, $longitude);
    }
}
