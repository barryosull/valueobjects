<?php

namespace EventSourced\ValueObject\ValueObject;

class IntegerTreeNode extends Type\AbstractTreeNode 
{    
    static protected function accepts()
    {
        return [
            'integer' => Integer::class,
            'integerCollection' => IntegerCollection::class
        ];
    }
}

