<?php

namespace EventSourced\ValueObject;

class SampleEntityIndex extends Type\AbstractIndex
{    
    public function collection_of()
    {
        return SampleEntity::class;
    }
}
