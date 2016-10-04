<?php

namespace EventSourced\ValueObject\Serializer\Serializer;

use EventSourced\ValueObject\Serializer\Exception;
use EventSourced\ValueObject\Serializer\Serializer;
use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use EventSourced\ValueObject\Serializer\Reflector;

class Composite
{    
    private $serializer;
    private $reflector;
    
    public function __construct(Serializer $serializer, Reflector $reflector)
    {
        $this->reflector = $reflector;
        $this->serializer = $serializer;
    }
    
    public function serialize(AbstractComposite $object)
    {
        $properties = $this->reflector->get_properties($object);
        
        $serialized = [];
        foreach ($properties as $parameter) {
            $name = $parameter->getName();
            $value_object = $parameter->getValue($object);
            if (!$value_object) {
                throw new Exception("Property '$name' is null, cannot encode. Please check a value is assigned in the constructor.");
            }
            $serialized[$name] = $this->serializer->serialize($value_object);
        }
		return $serialized;
    }
}
