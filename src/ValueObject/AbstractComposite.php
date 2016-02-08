<?php

namespace EventSourced\ValueObject;

abstract class AbstractComposite extends AbstractValueObject
{  
    private $value_objects;
    
    public function __construct()
    {
        $this->value_objects = func_get_args();
    }
    
	public function serialize() 
	{
        $reflection = new \ReflectionClass(get_called_class());
        $pararameters = $reflection->getConstructor()->getParameters();
        foreach ($pararameters as $index=>$parameter) {
            $name = $parameter->getName();
            $value = $this->value_objects[$index];   
            $serialized[$name] = $value->serialize();
        }
		return $serialized;
	}	

	public static function deserialize($serialized)
	{
		$reflection = new \ReflectionClass(get_called_class());
        $pararameters = $reflection->getConstructor()->getParameters();
        foreach ($pararameters as $parameter) {
            $name = $parameter->getName();
            $class = $parameter->getClass()->getName();
            $deserialized[$name] = $class::deserialize(
                $serialized[$name]
            );
        }
        return $reflection->newInstanceArgs($deserialized);
	}
}