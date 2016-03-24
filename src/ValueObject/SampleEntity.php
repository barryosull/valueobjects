<?php

namespace EventSourced\ValueObject;

class SampleEntity extends Type\AbstractEntity
{
    public $date;
    
    public function __construct(UUID $id, Date $date) 
    {
        $this->date = $date;
        parent::__construct($id, $date);
    }
}
