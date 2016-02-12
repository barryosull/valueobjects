<?php

namespace EventSourced\ValueObject;

abstract class AbstractIndex  extends AbstractCollection 
{    
    public function __construct(array $items) 
	{
        $validator = $this->item_validator();
        foreach ($items as $item) {
            $this->assert()->is($validator, $item);
            $this->collection[$item->id()->to_string()] = $item;
        }
	}

    public function add($item) 
    {
        $items = $this->collection;
        if ($this->exists($item->id())) {
            throw new \Exception("Entity already exists in index");
        }
        $items[$item->id()->to_string()] = $item;
        return new static($items);
    }
        
    public function exists($id)
    {
        return isset($this->collection[$id->to_string()]);
    }
        
    public function remove($id)
    {
        $items = $this->collection;
        delete($this->collection[$id->to_string()]);
        return new static($items);
    }
    
    public function replace($item)
    {
        $items = $this->collection;
        if (!$this->exists($item->id())) {
            throw new \Exception("Entity does not exist in index");
        }
        $items[$item->id()->to_string()] = $item;
        return new static($items);
    }
}
