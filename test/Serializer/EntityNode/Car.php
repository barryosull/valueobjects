<?php namespace Test\Serializer\EntityNode;

use EventSourced\ValueObject\ValueObject;

class Car extends ValueObject\Type\AbstractComposite
{
    protected $wheels;
    protected $seat;

    public function __construct(ValueObject\Integer $wheels, ValueObject\NotBlankString $seat)
    {
        $this->wheels = $wheels;
        $this->seat = $seat;
    }
}