<?php

namespace EventSourced\ValueObject\ValueObject;

class Coordinate extends Type\AbstractSingleValue 
{    
    protected function validator()
    {
        return parent::validator()->floatVal()->between(-90, 90);
    }
}
