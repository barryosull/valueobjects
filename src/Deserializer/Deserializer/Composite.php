<?php

namespace EventSourced\ValueObject\Deserializer\Deserializer;

use EventSourced\ValueObject\Deserializer\Deserializer;
use EventSourced\ValueObject\Deserializer\Reflector;
use EventSourced\ValueObject\Deserializer\Exception;

class Composite
{
    private $deserializer;
    private $reflector;

    private $serialized;
    private $errors = [];
    private $deserialized_parameters = [];
    
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
