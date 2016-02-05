<?php

namespace EventSourced\ValueObject\Contract;

interface ValueObject 
{
    public function equals(ValueObject $value_object);
    
    public function serialize();
    
    public static function deserialize($serialized);
}
