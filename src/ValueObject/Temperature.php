<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class Temperature extends AbstractComposite
{        
    public function __construct(TemperatureScale $scale, Float $value) 
	{
        parent::__construct($scale, $value);
    }
    
    protected function validator_class()
    {
        return Validator\Temperature::class;
    }
}
