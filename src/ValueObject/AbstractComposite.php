<?php

namespace EventSourced\ValueObject;

abstract class AbstractComposite extends AbstractValueObject
{  
    protected $value_objects;
    
    public function __construct()
    {
        $this->value_objects = func_get_args();
    }
    
    public function equals($other_valueobject) 
	{
        $result = true;
        foreach ($this->value_objects as $key=>$valueobject) {
            $result = $result && 
                $valueobject->equals($other_valueobject->value_objects[$key]);
        }
		return $result && parent::equals($other_valueobject);
	}
}