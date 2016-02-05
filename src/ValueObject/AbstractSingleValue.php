<?php

namespace EventSourced\ValueObject\ValueObject;

abstract class AbstractSingleValue extends AbstractValueObject
{	
	protected $value;

	public function __construct($value) 
	{
		$this->value = $value;
	}

	public function serialize() 
	{
		return $this->value;
	}

	public static function deserialize($value) 
	{
		return new self($value);
	}
}