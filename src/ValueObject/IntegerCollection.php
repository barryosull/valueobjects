<?php

namespace EventSourced\ValueObject;

class IntegerCollection extends AbstractCollection 
{    
    public function collection_of_class()
    {
        return Integer::class;
    }
}
