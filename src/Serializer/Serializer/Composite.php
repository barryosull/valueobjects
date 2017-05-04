<?php namespace EventSourced\ValueObject\Serializer\Serializer;

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
                $serialized[$name] = null;
            } else {
                $serialized[$name] = $this->serializer->serialize($value_object);
            }
        }

        if ($this->all_properties_are_null($serialized)) {
            return null;
        }

		return $serialized;
    }

    private function all_properties_are_null($serialized)
    {
        $no_nulls = array_filter($serialized, function($var){
            return !is_null($var);
        } );
        return count($no_nulls) == 0;
    }
}
