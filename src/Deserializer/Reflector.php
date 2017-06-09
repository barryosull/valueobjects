<?php

namespace EventSourced\ValueObject\Deserializer;

interface Reflector
{
    public function get_constructor_parameters($class);
    
    public function call_constructor($class, array $parameters);

    public function get_method_parameters($class, $method);
}