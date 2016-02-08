<?php

namespace EventSourced\ValueObject;

abstract class AbstractSingleValue extends AbstractValueObject
{	
	protected $value;
    
    abstract protected function validator_class();

	public function __construct($value) 
	{
        $this->assert()->is($this->validator_class(), [$value]);
		$this->value = $value;
	}

	public function serialize() 
	{
		return $this->value;
	}

	public static function deserialize($value) 
	{
		return new static($value);
	}
}