<?php namespace EventSourced\ValueObject\Deserializer\Deserializer;

use EventSourced\ValueObject\Deserializer\Deserializer;
use EventSourced\ValueObject\Deserializer\Reflector;
use EventSourced\ValueObject\Deserializer\Exception;

class TypeEntity
{    
    private $deserializer;
    private $reflector;

    private $serialized;
    private $errors = [];
    private $deserialized_parameters = [];

    private $variable_property;
    private $variable_property_class;
    
    public function __construct(Deserializer $deserializer, Reflector $reflector)
    {
        $this->deserializer = $deserializer;
        $this->reflector = $reflector;
    }

    public function deserialize($class, $serialized)
    {
        $this->serialized = $serialized;
        $this->errors = [];
        $this->deserialized_parameters = [];

        $this->variable_property = $class::variable_property_key();
        $this->variable_property_class = $class::get_class_for_type_key($serialized['type']);

        $parameters = $this->reflector->get_constructor_parameters($class);
        foreach ($parameters as $parameter) {
            $this->make_parameter($parameter);
        }

        if (count($this->errors) != 0) {
            throw new Exception($this->errors);
        }

        return $this->reflector->call_constructor($class, $this->deserialized_parameters);
    }

    private function make_parameter($parameter)
    {

        $name = $parameter->getName();
        $parameter_class = $parameter->getClass()->getName();

        if ($name == $this->variable_property) {
            $parameter_class = $this->variable_property_class;
        }

        if (!isset($this->serialized[$name])) {
            $this->errors[$name] = ["Property '$name' is missing"];
            return;
        }

        try {
            $this->deserialized_parameters[$name] = $this->deserializer->deserialize(
                $parameter_class, $this->serialized[$name]
            );
        } catch (\DomainException $e) {
            $this->errors[$name] = $e->error_messages();
        }
    }
}


