<?php

namespace EventSourced\Serializer\ValueObject;

class AbstractSerializer 
{    
    protected function get_private_property($object, $property_name)
    {
        $reflection = $this->relection_factory(get_class($object));
        $property = $reflection->getProperty($property_name);
        $property->setAccessible(true);
        return $property->getValue($object);
    }
    
    protected function get_constructor_parameters($class)
    {
        $reflection = $this->relection_factory($class);
        return $reflection->getConstructor()->getParameters();
    }
        
    protected function call_constructor($class, $arguments)
    {
        $reflection = $this->relection_factory($class);
        return $reflection->newInstanceArgs($arguments);
    }
    
    private static $vo_to_reflection_cache = [];
    
    private function relection_factory($class_name)
    {
        if (!isset(self::$vo_to_reflection_cache[$class_name])) {
            $reflection = new \ReflectionClass($class_name);
            self::$vo_to_reflection_cache[$class_name] = $reflection; 
        }
        return self::$vo_to_reflection_cache[$class_name];
    }
}
