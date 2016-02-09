<?php

namespace EventSourced\Validator;

class TemperatureScale extends AbstractEnum {
    
    protected function enums() {
        return [
          'c',
          'f'
        ];
    }
}
