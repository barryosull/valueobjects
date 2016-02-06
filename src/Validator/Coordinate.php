<?php

namespace EventSourced\Validator;

use EventSourced\Validator;

class Coordinate extends AbstractComposite
{
    public function __construct()
    {
        $this->append_validator(new Validator\Float());
        $this->append_validator(new Validator\GreaterThanOrEqual(-90));
        $this->append_validator(new Validator\LessThanOrEqual(90));
    }
}
