<?php

namespace EventSourced\ValueObject\ValueObject;

class SampleEntity extends Type\AbstractEntity
{
    public $date;
    
    public function __construct(Uuid $id, Date $date) 
    {
        $this->date = $date;
        parent::__construct($id, $date);
    }
}
