<?php

namespace EventSourced\Validator;

class Integer extends AbstractComposite
{    
    public function is_satisfied_by($arguments)
    {
        return is_numeric($arguments[0]) && (int)$arguments[0] == $arguments[0];
    }
}
