<?php

namespace EventSourced\ValueObject;

use EventSourced\Contract;
use EventSourced\Assert\Assert;

abstract class AbstractValueObject implements Contract\ValueObject
{	    
    public function equals(Contract\ValueObject $valueobject) 
	{
		return ($this->serialize() == $valueobject->serialize())
            && (get_class($this) == get_class($valueobject));
	}
    
    protected function assert()
    {
        return new Assert(get_called_class());
    }
    
    public function serialize() 
	{
        return (new \EventSourced\Serializer\Serializer())->serialize($this);
	}

	public static function deserialize($value) 
	{
        return (new \EventSourced\Serializer\Serializer())->deserialize(get_called_class(),  $value);
	}
}