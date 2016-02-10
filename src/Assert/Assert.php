<?php

namespace EventSourced\Assert;

class Assert 
{        
    private $calling_class;
    
    public function __construct($calling_class) 
    {
        $this->calling_class = $calling_class;
    }
    
    public function is($validator, $value) 
    {
        if (!$validator->is_satisfied_by($value)) {
            throw new IsException($value, $this->calling_class);
        }
    }
    
    public function not($validator, $value) 
    {
        if ($validator->is_satisfied_by($value)) {
            throw new NotException($value, $this->calling_class);
        }
    }
}
