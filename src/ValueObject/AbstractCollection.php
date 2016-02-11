<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

abstract class AbstractCollection extends AbstractValueObject
{	
	protected $collection = [];
    
    abstract protected function collection_of_class();
    
    protected function item_validator() 
    {
        return Validator::instance($this->collection_of_class());
    }

	public function __construct(array $items) 
	{
        $validator = $this->item_validator();
        foreach ($items as $item) {
            $this->assert()->is($validator, $item);
        }
        $this->collection = $items;
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
    
    public static function deserialize($serialized) 
	{
        $collection = new static([]);
        $collection_of_class = $collection->collection_of_class();
        foreach ($serialized as $value) {
            $collection = $collection->add( $collection_of_class::deserialize($value) );
        }
		return $collection;
	}
    
    public function serialize() 
	{
        $serialized = array_map(function($item){
            return $item->serialize();
        }, $this->collection);
		return array_values($serialized);
	}
}