<?php

namespace EventSourced\ValueObject\ValueObject;

use EventSourced\ValueObject\Contracts\ValueObject;
use EventSourced\ValueObject\ValueObject\Type\AbstractTypeObject;

class SampleCompositeWithVariableType extends AbstractTypeObject
{
    protected $type;
    protected $value;

    public function __construct(SampleType $type, ValueObject $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    protected static function accepts()
    {
        return [
            'default' => Uuid::class,
            'coordinates' => GPSCoordinates::class
        ];
    }

    public static function variable_property_key()
    {
        return 'value';
    }
}