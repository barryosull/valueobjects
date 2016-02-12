<?php

namespace EventSourced\Serializer\ValueObject;

use EventSourced\ValueObject\AbstractComposite;

class Composite extends AbstractSerializer
{    
    public function serialize(AbstractComposite $object)
    {
        $pararameters = $this->get_constructor_parameters(get_class($object));
        $value_objects = $this->get_private_property($object, 'value_objects');
        
        foreach ($pararameters as $index=>$parameter) {
            $name = $parameter->getName();
            $value = $value_objects[$index]; 
            $serialized[$name] = $value->serialize();
        }
		return $serialized;
    }
    
    public function deserialize($class, $serialized)
    {
        $deserialized_parameters = [];
        $parameters = $this->get_constructor_parameters($class);
        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            $parameter_class = $parameter->getClass()->getName();
            $deserialized_parameters[$name] = $parameter_class::deserialize(
                $serialized[$name]
            );
        }
        return $this->call_constructor($class, $deserialized_parameters);
    }

}
