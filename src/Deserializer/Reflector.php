<?php

namespace EventSourced\Deserializer;

interface Reflector
{
    public function get_constructor_parameters($class);
    
    public function call_constructor($class, array $parameters);
}