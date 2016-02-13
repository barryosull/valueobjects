<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

abstract class AbstractCollection extends AbstractValueObject
{	
	protected $collection = [];
    
    abstract public function collection_of();
    
    protected function item_validator() 
    {
        return Validator::instance($this->collection_of());
    }

	public function __construct(array $items) 
	{
        $validator = $this->item_validator();
        foreach ($items as $item) {
            $this->assert()->is($validator, $item);
        }
        $this->collection = $items;
	}
    
    public function equals($other_valueobject) 
	{
        $result = true;
        foreach ($this->collection as $key=>$valueobject) {
            $result = $result && 
                $valueobject->equals($other_valueobject->collection[$key]);
        }
		return $result && parent::equals($other_valueobject);
	}

    public function add($item) 
    {
        $items = $this->collection;
        $items[] = $item;
        return new static($items);
    }
    
    public function count() 
    {
        return count($this->collection);
    }
    
    public function exists($item)
    {
        foreach($this->collection as $compare_item) {
            if ($item->equals($compare_item)) {
                return true;
            }
        }
        return false;
    }
        
    public function remove($item)
    {
        $items = [];
        foreach($this->collection as $compare_item) {
            if (!$item->equals($compare_item)) {
                $items[] = $compare_item;
            }
        }
        return new static($items);
    }
}