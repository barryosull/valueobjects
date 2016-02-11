<?php

namespace EventSourced\ValueObject;

class SampleEntity extends AbstractEntity
{
    public function __construct(UUID $id, Date $date) 
    {
        parent::__construct($id, $date);
    }
}
