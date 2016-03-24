<?php

namespace EventSourced\ValueObject\Deserializer\Deserializer;

class SingleValue
{        
    public function deserialize($class, $serialized)
    {
        return new $class($serialized);
    }
}
