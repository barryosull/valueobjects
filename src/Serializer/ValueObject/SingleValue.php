<?php

namespace EventSourced\Serializer\ValueObject;

use EventSourced\ValueObject\AbstractSingleValue;

class SingleValue extends AbstractSerializer
{    
    public function serialize(AbstractSingleValue $object)
    {
        return $this->get_private_property($object, 'value');
    }
    
    public function deserialize($class, $serialized)
    {
        return new $class($serialized);
    }
}
