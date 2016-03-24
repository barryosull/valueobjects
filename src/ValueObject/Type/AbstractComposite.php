<?php

namespace EventSourced\ValueObject\Type;

use EventSourced\Contract\ValueObject;

abstract class AbstractComposite extends AbstractValueObject
{  
    protected $value_objects;
    
    public function __construct()
    {
        $this->value_objects = func_get_args();
    }
    
    public function equals(ValueObject $other_valueobject) 
	{
        $result = $this->is_same_class($other_valueobject);
        if (!$result) {
            return $result;
        }
        foreach ($this->value_objects as $key=>$valueobject) {
            $result = $result && 
                $valueobject->equals($other_valueobject->value_objects[$key]);
        }
		return $result;
	}
}