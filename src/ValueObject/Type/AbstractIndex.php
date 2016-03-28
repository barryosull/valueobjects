<?php

namespace EventSourced\ValueObject\ValueObject\Type;

use EventSourced\ValueObject\Contracts\ValueObject\Identifier;

abstract class AbstractIndex extends AbstractSet
{    
    protected function item_key($item)
    {
        return $item->id()->value();
    }

    public function add($item) 
    {
        $items = $this->collection();
        if ($this->exists($item->id())) {
            throw new \Exception("Entity already exists in index");
        }
        $items[$item->id()->value()] = $item;
        return new static($items);
    }
        
    public function exists(Identifier $id)
    {
        return isset($this->collection()[$id->value()]);
    }
        
    public function remove(Identifier $id)
    {
        $items = $this->collection();
        unset($items[$id->value()]);
        return new static($items);
    }
    
    public function replace($item)
    {
        $items = $this->collection();
        if (!$this->exists($item->id())) {
            throw new \Exception("Entity does not exist in index");
        }
        $items[$item->id()->value()] = $item;
        return new static($items);
    }
    
    public function get(Identifier $id) 
    {
        if (!$this->exists($id)) {
            throw new \Exception("Cannot find object for key '".$id->value()."'");
        }
        return $this->collection()[$id->value()];
    }
}
