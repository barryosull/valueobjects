<?php

namespace EventSourced\ValueObject;

class SampleEntityIndex extends AbstractIndex
{    
    public function collection_of_class()
    {
        return SampleEntity::class;
    }
}
