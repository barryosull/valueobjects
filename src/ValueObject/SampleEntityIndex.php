<?php

namespace EventSourced\ValueObject;

class SampleEntityIndex extends AbstractIndex
{    
    protected function collection_of_class()
    {
        return SampleEntity::class;
    }
}
