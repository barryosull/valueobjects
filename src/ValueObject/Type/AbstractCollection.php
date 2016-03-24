<?php

namespace EventSourced\ValueObject\ValueObject\Type;

abstract class AbstractCollection extends AbstractSet
{	    
    private $count = 0;
    protected function item_key($item)
    {
        $this->count++;
        return $this->count-1;
    }
    
    public function add($item) 
    {
        $items = $this->collection();
        $items[] = $item;
        return new static($items);
    }
    
    public function count() 
    {
        return count($this->collection());
    }
    
    public function exists($item)
    {
        foreach($this->collection() as $compare_item) {
            if ($item->equals($compare_item)) {
                return true;
            }
        }
        return false;
    }
        
    public function remove($item)
    {
        $items = [];
        foreach($this->collection() as $compare_item) {
            if (!$item->equals($compare_item)) {
                $items[] = $compare_item;
            }
        }
        return new static($items);
    }
    
    public function get($index) 
    {
        $collection = $this->collection();
        if (!isset($collection[$index])) {
            throw new \Exception("Cannot find object for index '$index'");
        }
        return $collection[$index];
    }
}