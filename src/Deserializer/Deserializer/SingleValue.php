<?php

namespace EventSourced\Deserializer\Deserializer;

class SingleValue
{        
    public function deserialize($class, $serialized)
    {
        return new $class($serialized);
    }
}
