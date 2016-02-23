<?php

namespace EventSourced\ValueObject;

class IntegerTreeNode extends AbstractTreeNode 
{    
    static protected function accepts()
    {
        return [
            'integer' => Integer::class,
            'integerCollection' => IntegerCollection::class
        ];
    }
}

