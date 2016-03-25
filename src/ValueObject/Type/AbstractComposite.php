<?php

namespace EventSourced\ValueObject\ValueObject\Type;

use EventSourced\ValueObject\Contracts\ValueObject;

abstract class AbstractComposite extends AbstractValueObject
{  
    public function equals(ValueObject $other_valueobject) 
	{
        $result = $this->is_same_class($other_valueobject);
        if (!$result) {
            return $result;
        }
        foreach ($this as $key=>$valueobject) {
            $result = $result && 
                $valueobject->equals($other_valueobject->$key);
        }
		return $result;
	}
}