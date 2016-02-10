<?php

namespace EventSourced\ValueObject;

class AscendingIntegerCollection  extends AbstractAscendingCollection 
{    
    protected function collection_of_class()
    {
        return Integer::class;
    }
}
