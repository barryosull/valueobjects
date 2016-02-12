<?php

namespace EventSourced\ValueObject;

abstract class AbstractSingleValue extends AbstractValueObject
{	
	protected $value;
    
    abstract protected function validator();

	public function __construct($value) 
	{
        $this->assert()->is($this->validator(), $value);
		$this->value = $value;
	}
    
    public function equals($valueobject) 
	{
		return $this->value == $valueobject->value 
                && parent::equals($valueobject);
	}
}