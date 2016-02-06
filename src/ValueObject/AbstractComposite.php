<?php

namespace EventSourced\ValueObject;

abstract class AbstractComposite extends AbstractValueObject
{
    protected $values = [];
    
	public function serialize() 
	{
		$serialized = [];
		foreach ($this->values as $property => $value) {
			$serialized[$property] = method_exists($value, 'serialize') 
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