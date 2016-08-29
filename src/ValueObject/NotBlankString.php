<?php namespace EventSourced\ValueObject\ValueObject;

class NotBlankString extends Type\AbstractSingleValue
{
    protected function validator()
    {
        return parent::validator()->notBlank();
    }
}
