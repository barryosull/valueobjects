<?php

namespace EventSourced\ValueObject\ValueObject;

use EventSourced\ValueObject\ValueObject\Type\AbstractTypeObject;
use Money\Money;

class SampleCompositeWithVariableType extends AbstractTypeObject
{
    protected $type;
    protected $value;

    public function __construct(SampleType $type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    protected static function accepts()
    {
        return [
            'default' => Uuid::class,
            'coordinates' => GPSCoordinates::class,
            'money' => Money::class
        ];
    }

    public static function variable_property_key()
    {
        return 'value';
    }
}