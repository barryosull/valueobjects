<?php

namespace EventSourced\Validator;

class Date extends AbstractComposite
{ 
    public function is_satisfied_by($arguments)
    {
        return strtotime($arguments[0]) !== false;
    }
}
