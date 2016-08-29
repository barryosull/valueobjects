<?php namespace Test\Serializer\EntityNode;

use EventSourced\ValueObject\ValueObject;

class Bike extends ValueObject\Type\AbstractComposite
{
    protected $lights;
    protected $saddle;

    public function __construct(ValueObject\Integer $lights, ValueObject\NotBlankString $saddle)
    {
        $this->lights = $lights;
        $this->saddle = $saddle;
    }
}