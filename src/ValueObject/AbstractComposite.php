<?php

namespace EventSourced\ValueObject;

abstract class AbstractComposite extends AbstractValueObject
{
	public function serialize() 
	{
		$serialized = [];
		foreach ($this as $property => $value) {
			$serialized[$property] = methods_exists($value, 'serialize') 
				? $value->serialize()
				: $value;
		}
		return $serialized;
	}	

	public static function deserialize($serialized)
	{
		$reflection = new \ReflectionClass(self);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            $property_name = $property->getName();
            $property_class = $property->class;
            $deserialized[$property_name] = $property_class::deserialize(
                $serialized[$property_name]
            );
        }
        return $reflection->newInstanceArgs($deserialized);
	}
}