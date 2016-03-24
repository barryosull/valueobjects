<?php

namespace EventSourced\Deserializer\Deserializer;

use EventSourced\Deserializer\Deserializer;
use EventSourced\Deserializer\Reflector;

class Composite
{    
    private $deserializer;
    private $reflector;
    
    public function __construct(Deserializer $deserializer, Reflector $reflector)
    {
        $this->deserializer = $deserializer;
        $this->reflector = $reflector;
    }
    
    public function deserialize($class, $serialized)
    {
        $deserialized_parameters = [];
        $parameters = $this->reflector->get_constructor_parameters($class);
        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            $parameter_class = $parameter->getClass()->getName();
            $deserialized_parameters[$name] = $this->deserializer->deserialize(
                $parameter_class, $serialized[$name]
            );
        }
        return $this->reflector->call_constructor($class, $deserialized_parameters);
    }

}
