<?php

namespace EventSourced\Validator;

use EventSourced\ValueObject;

class Temperature extends AbstractComposite
{    
    public function is_satisfied_by($arguments)
    {
        $scale = $arguments[0];
        $temperature_value = $arguments[1]->serialize();
        
        $validator = new Fahrenheit();
        if ($scale->equals( new ValueObject\TemperatureScale('c'))) {
            $validator = new Celsius();   
        }
        return $validator->is_satisfied_by([$temperature_value]);
    }
}
