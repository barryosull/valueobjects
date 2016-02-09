<?php

namespace EventSourced\Validator;

use EventSourced\Specification;
use EventSourced\Contract;

abstract class AbstractWrapper extends Specification\Wrapper implements Contract\Validator
{
    abstract protected function compostite_validator();
    
    public function __construct() {
        parent::__construct($this->compostite_validator());
    }
}
