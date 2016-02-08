<?php

namespace EventSourced\ValueObject;

abstract class AbstractComposite extends AbstractValueObject
{  
	public function serialize() 
	{
        $reflect = new \ReflectionClass($this);
        $props = $reflect->getProperties();
        $serialized = [];
        foreach ($props as $property) {
            $property->setAccessible(true);
            $name = $property->getName();
            $value = $property->getValue($this);
            $serialized[$name] = method_exists($value, 'serialize') 
				? $value->serialize()
				: $value;
        }
		return $serialized;
	}	

	public static function deserialize($serialized)
	{
		$reflection = new \ReflectionClass(get_called_class());
        $pararameters = $reflection->getConstructor()->getParameters();
        foreach ($pararameters as $parameter) {
            $parameter_name = $parameter->getName();
            $parameter_class = $parameter->getClass()->getName();
            $deserialized[$parameter_name] = $parameter_class::deserialize(
                $serialized[$parameter_name]
            );
        }
        return $reflection->newInstanceArgs($deserialized);
	}
}