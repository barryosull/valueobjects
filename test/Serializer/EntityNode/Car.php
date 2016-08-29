<?php namespace Test\Serializer\EntityNode;

use EventSourced\ValueObject\ValueObject;

class Car extends ValueObject\Type\AbstractComposite
{
    protected $wheels;
    protected $seats;

    public function __construct(ValueObject\Integer $wheels, ValueObject\NotBlankString $seats)
    {
        $this->wheels = $wheels;
        $this->seats = $seats;
    }
}