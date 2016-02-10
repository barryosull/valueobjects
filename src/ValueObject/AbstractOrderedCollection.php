<?php

namespace EventSourced\ValueObject;

abstract class AbstractOrderedCollection extends AbstractCollection
{
    abstract protected function order_validator_class();
    
    public function __construct(array $items)
    {
        $validator_class = $this->order_validator_class();
        for ($i = 0, $l = count($items); $i < $l-1; $i++) {
            $value_a = $items[$i];
            $value_b = $items[$i+1];
            $validator = new $validator_class($value_a->serialize());
            $this->assert()->is($validator, $value_b->serialize());
        } 
        parent::__construct($items);
    }
}
