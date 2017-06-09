<?php

namespace EventSourced\ValueObject\Reflector;

use EventSourced\ValueObject\Deserializer;
use EventSourced\ValueObject\Serializer;

class Reflector implements Deserializer\Reflector, Serializer\Reflector
{
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
    
    public function get_properties($object)
    {
        $reflection = $this->relection_factory(get_class($object));
        $properties =  $reflection->getProperties();
        foreach ($properties as $property) {
            $property->setAccessible(true);
        }
        return $properties;
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

    public function get_method_parameters($class, $method)
    {
        $reflection = new \ReflectionMethod($class, $method);
        return $reflection->getParameters();
    }
}