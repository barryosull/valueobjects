<?php

namespace EventSourced\ValueObject\Deserializer\Deserializer;

use EventSourced\ValueObject\Deserializer\Deserializer;
use EventSourced\ValueObject\Deserializer\Reflector;

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

            if (!isset($serialized[$name])) {
                throw new \Exception("Expected the key '$name' for type '$class', cannot deserialized. (check your schema is valid)");
            }

            $deserialized_parameters[$name] = $this->deserializer->deserialize(
                $parameter_class, $serialized[$name]
            );
        }
        return $this->reflector->call_constructor($class, $deserialized_parameters);
    }

}
