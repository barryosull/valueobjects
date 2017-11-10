<?php namespace EventSourced\ValueObject\ValueObject;

use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;

class NonNullableComposite extends AbstractComposite
{
    protected $property_1;
    protected $property_2;

    public function __construct(AcceptAnything $property_1, AcceptAnything $property_2)
    {
        $this->property_1 = $property_1;
        $this->property_2 = $property_2;
    }
}