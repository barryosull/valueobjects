<?php

namespace EventSourced\ValueObject;

class IntegerCollection extends Type\AbstractCollection 
{    
    public function collection_of()
    {
        return Integer::class;
    }
}
