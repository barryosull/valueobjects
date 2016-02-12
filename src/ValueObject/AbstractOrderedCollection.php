<?php

namespace EventSourced\ValueObject;

abstract class AbstractOrderedCollection extends AbstractCollection
{
    abstract protected function order_validator($preceding_value);
    
    public function __construct(array $items)
    {
        for ($i = 0, $l = count($items); $i < $l-1; $i++) {
            $item_a = $items[$i];
            $item_b = $items[$i+1];
            $validator = $this->order_validator($item_a);
            $this->assert()->is($validator, $item_b);
        } 
        parent::__construct($items);
    }
}
