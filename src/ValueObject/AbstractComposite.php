<?php

namespace EventSourced\ValueObject;

abstract class AbstractComposite extends AbstractValueObject
{  
    private $value_objects;
    
    public function __construct()
    {
        $this->value_objects = func_get_args();
        if ($this->validator_class()) {
            $this->assert()->is($this->validator_class(), $this->value_objects);
        }
    }
    
    protected function validator_class()
    {
        return null;
    }
    
	public function serialize() 
	{
        $pararameters = self::relection_factory(get_called_class())
            ->getConstructor()->getParameters();
        foreach ($pararameters as $index=>$parameter) {
            $name = $parameter->getName();
            $value = $this->value_objects[$index];   
            $serialized[$name] = $value->serialize();
        }
		return $serialized;
	}
    
    private static $vo_to_reflection_cache = [];

    private static function relection_factory($class_name)
    {
        if (!isset(self::$vo_to_reflection_cache[$class_name])) {
            $reflection = new \ReflectionClass(get_called_class());
            self::$vo_to_reflection_cache[$class_name] = $reflection; 
        }
        return self::$vo_to_reflection_cache[$class_name];
    }
    
	public static function deserialize($serialized)
	{
		$reflection = self::relection_factory(get_called_class());
        $parameters = $reflection->getConstructor()->getParameters();
        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            $class = $parameter->getClass()->getName();
            $deserialized[$name] = $class::deserialize(
                $serialized[$name]
            );
        }
        return $reflection->newInstanceArgs($deserialized);
	}
}