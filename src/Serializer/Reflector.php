<?php

namespace EventSourced\ValueObject\Serializer;

interface Reflector 
{    
    public function get_properties($object);
}
