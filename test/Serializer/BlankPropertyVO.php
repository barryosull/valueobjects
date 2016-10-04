<?php namespace Test\Serializer;

use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use EventSourced\ValueObject\ValueObject\Uuid;

class BlankPropertyVO extends AbstractComposite
{
    protected $id;
    protected $no_value;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }
}