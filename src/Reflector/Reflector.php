<?php

namespace EventSourced\Reflector;

use EventSourced\Deserializer;
use EventSourced\Serializer;

class Reflector implements Deserializer\Reflector, Serializer\Reflector
{
    public function get_private_property($object, $property_name)
    {
        $reflection = $this->relection_factory(get_class($object));
        $property = $reflection->getProperty($property_name);
        $property->setAccessible(true);
        return $property->getValue($object);
    }
    
    public function call_constructor($class, array $arguments)
    {
        $reflection = $this->relection_factory($class);
        return $reflection->newInstanceArgs($arguments);
    }
    
    public function get_constructor_parameters($class)
    {
        $reflection = $this->relection_factory($class);
        return $reflection->getConstructor()->getParameters();
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