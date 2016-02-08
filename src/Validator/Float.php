<?php

namespace EventSourced\Validator;

class Float extends AbstractComposite
{
    private $value;
    
    public function is_satisfied_by($arguments)
    {
        $this->value = $arguments[0];
        return is_numeric($arguments[0]);
    }
}
