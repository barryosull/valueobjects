<?php namespace EventSourced\ValueObject\Assert;

use Respect\Validation\Exceptions\NestedValidationException;
use EventSourced\ValueObject\ValidationException;

class Assert 
{        
    private $calling_class;
    
    public function __construct($calling_class) 
    {
        $this->calling_class = $calling_class;
    }
    
    public function is($validator, $value) 
    {
        try {
            $validator->assert($value);
        } catch(NestedValidationException $exception) {
            throw new Exception($this->calling_class, $exception->getMessages());
        }
    }
}
