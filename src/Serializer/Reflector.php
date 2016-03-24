<?php

namespace EventSourced\ValueObject\Serializer;

interface Reflector 
{    
    public function get_private_property($object, $property_name);
    
    public function get_constructor_parameters($class);
}
