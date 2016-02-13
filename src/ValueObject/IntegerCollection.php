<?php

namespace EventSourced\ValueObject;

class IntegerCollection extends AbstractCollection 
{    
    public function collection_of()
    {
        return Integer::class;
    }
}
