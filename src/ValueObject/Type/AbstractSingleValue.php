<?php

namespace EventSourced\ValueObject\ValueObject\Type;

use EventSourced\ValueObject\Contracts\ValueObject;

abstract class AbstractSingleValue extends AbstractValueObject
{	
	protected $value;
    
    abstract protected function validator();

	public function __construct($value) 
	{
        $this->assert()->is($this->validator(), $value);
		$this->value = $value;
	}
    
    public function equals(ValueObject $valueobject) 
	{
		return $this->is_same_class($valueobject)
            && $this->value == $valueobject->value;
	}
    
    public function value()
    {
        return $this->value;
    }
}