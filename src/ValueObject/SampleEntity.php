<?php

namespace EventSourced\ValueObject;

class SampleEntity extends AbstractEntity
{
    public $datetime;
    
    public function __construct(UUID $id, DateTime $datetime) 
    {
        $this->datetime = $datetime;
        parent::__construct($id, $datetime);
    }
}
