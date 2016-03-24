<?php

namespace EventSourced\ValueObject\ValueObject;

class SampleEntityIndex extends Type\AbstractIndex
{    
    public function collection_of()
    {
        return SampleEntity::class;
    }
}
