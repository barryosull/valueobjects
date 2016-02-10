<?php

namespace EventSourced\ValueObject;

class IntegerCollection extends AbstractCollection 
{    
    protected function collection_of_class()
    {
        return Integer::class;
    }
}
