<?php

namespace EventSourced\ValueObject\ValueObject;

use EventSourced\ValueObject\ValueObject\Type\AbstractSingleValue;

class SampleType extends AbstractSingleValue
{
    protected function validator()
    {
        return parent::validator()->in([
            'default',
            'coordinates',
            'money'
        ]);
    }
}