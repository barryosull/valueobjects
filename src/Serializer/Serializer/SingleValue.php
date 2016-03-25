<?php

namespace EventSourced\ValueObject\Serializer\Serializer;

use EventSourced\ValueObject\ValueObject\Type\AbstractSingleValue;

class SingleValue
{    
    public function serialize(AbstractSingleValue $object)
    {
        return $object->value();
    }
}
