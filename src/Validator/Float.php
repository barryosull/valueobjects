<?php

namespace EventSourced\Validator;

class Float extends AbstractComposite
{    
    public function is_satisfied_by($arguments)
    {
        return is_numeric($arguments[0]);
    }
}
