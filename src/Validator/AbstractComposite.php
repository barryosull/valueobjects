<?php

namespace EventSourced\Validator;

use EventSourced\Contract;

abstract class AbstractComposite implements Contract\Validator
{
    private $validators = [];
    private $error_message;
    
    protected function append_validator(Contract\Validator $validator) 
    {
        $this->validators[] = $validator;
    }
    
    public function is_valid($arguments)
    {
        $this->error_message = null;
        $result = true;
        foreach ($this->validators as $validator) {
            if ($result && !$validator->is_valid($arguments)) {
                $this->error_message = $validator->error_message();
                $result = false;
            }
        }
        return $result;
    }
    
    public function error_message()
    {
        return $this->error_message;
    }
}
