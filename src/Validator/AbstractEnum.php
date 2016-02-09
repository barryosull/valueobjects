<?php

namespace EventSourced\Validator;

abstract class AbstractEnum extends AbstractComposite
{    
    public function is_satisfied_by($arguments)
    {
        return in_array($arguments[0], $this->enums());
    }
    
    abstract protected function enums();
}
