<?php

namespace EventSourced\ValueObject\Serializer\Serializer;

use EventSourced\ValueObject\ValueObject\Type\AbstractSingleValue;
use EventSourced\ValueObject\Serializer\Reflector;

class SingleValue
{    
    private $reflector;
    
    public function __construct(Reflector $reflector)
    {
        $this->reflector = $reflector;
    }
    
    public function serialize(AbstractSingleValue $object)
    {
        return $this->reflector->get_private_property($object, 'value');
    }
}
