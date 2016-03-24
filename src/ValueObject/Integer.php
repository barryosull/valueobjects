<?php

namespace EventSourced\ValueObject\ValueObject;

use Respect\Validation\Validator;

class Integer extends Type\AbstractSingleValue
{    
    protected function validator()
    {
        return Validator::intVal();
    }
    
    public function reset()
    {
        return new Integer(0);
    }

    public function increment()
    {
        $new_value = $this->value() + 1;

        return new Integer($new_value);
    }

    public function decrement()
    {
        $new_value = $this->value() - 1;

        return new Integer($new_value);
    }

    public function add(Integer $other)
    {
        return new Integer(
            $this->value() + $other->value()
        );
    }
    
    public function subtract(Integer $other)
    {
        return new Integer(
            $this->value() - $other->value()
        );
    }
}
