<?php namespace Test\Serializer\EntityNode;

use EventSourced\ValueObject\ValueObject\Type\AbstractSingleValue;

class Type extends AbstractSingleValue
{
    protected function validator()
    {
        return parent::validator()->in(['car', 'bike']);
    }
}