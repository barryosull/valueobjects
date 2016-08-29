<?php namespace EventSourced\ValueObject\Deserializer\Deserializer;

use EventSourced\ValueObject\Deserializer\Deserializer;
use EventSourced\ValueObject\Deserializer\Reflector;

class TypeEntity
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
        $variable_property = $class::variable_property_key();
        $variable_property_class = $class::get_class_for_type_key($serialized['type']);

        $deserialized_parameters = [];
        $parameters = $this->reflector->get_constructor_parameters($class);
        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            $parameter_class = $parameter->getClass()->getName();

            if ($name == $variable_property) {
                $parameter_class = $variable_property_class;
            }

            $deserialized_parameters[$name] = $this->deserializer->deserialize(
                $parameter_class, $serialized[$name]
            );
        }
        return $this->reflector->call_constructor($class, $deserialized_parameters);
    }
}


