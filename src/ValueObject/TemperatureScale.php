<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class TemperatureScale extends AbstractSingleValue
{        
    protected function validator_class()
    {
        return Validator\TemperatureScale::class;
    }
}
