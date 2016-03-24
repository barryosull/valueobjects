<?php

namespace EventSourced\Serializer\Serializer;

use EventSourced\Serializer\Serializer;
use EventSourced\ValueObject\Type\AbstractComposite;
use EventSourced\Serializer\Reflector;

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
        $pararameters = $this->reflector->get_constructor_parameters(get_class($object));
        $value_objects = $this->reflector->get_private_property($object, 'value_objects');
        
        foreach ($pararameters as $index=>$parameter) {
            $name = $parameter->getName();
            $value = $value_objects[$index]; 
            $serialized[$name] = $this->serializer->serialize($value);
        }
		return $serialized;
    }
}
