<?php

namespace EventSourced\ValueObject\Deserializer\Deserializer;

use EventSourced\ValueObject\Deserializer\Deserializer;

class TreeNode
{    
    private $deserializer;
    
    public function __construct(Deserializer $deserializer)
    {
        $this->deserializer = $deserializer;
    }

    public function deserialize($class, $serialized)
    {
        $value_object_class = $class::get_class_for_type_key($serialized['type']);
        $value_object = $this->deserializer->deserialize($value_object_class, $serialized['value']);
        return new $class($value_object);
    }
}


