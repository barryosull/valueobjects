<?php

namespace EventSourced\ValueObject;

class SampleEntityIndex extends AbstractIndex
{    
    public function collection_of()
    {
        return SampleEntity::class;
    }
}
