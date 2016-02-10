<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

abstract class AbstractCollection extends AbstractValueObject
{	
	protected $collection;
    
    abstract protected function collection_of_class();
    
    protected function item_validator() 
    {
        return new Validator\ClassType($this->collection_of_class());
    }

	public function __construct(array $items) 
	{
        $validator = $this->item_validator();
        foreach ($items as $item) {
            $this->assert()->is($validator, $item);
        }
        $this->collection = $items;
	}

	public function serialize() 
	{
		return array_map(function($item){
            return $item->serialize();
        }, $this->collection);
	}

	public static function deserialize($serialized) 
	{
        $collection = new static([]);
        $collection_of_class = $collection->collection_of_class();
        foreach ($serialized as $value) {
            $collection = $collection->append( $collection_of_class::deserialize($value) );
        }
		return $collection;
	}
    
    public function append($item) 
    {
        $items = $this->collection;
        $items[] = $item;
        return new static($items);
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