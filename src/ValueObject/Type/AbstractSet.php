<?php

namespace EventSourced\ValueObject\Type;

use EventSourced\Contract\ValueObject;
use Respect\Validation\Validator;

abstract class AbstractSet extends AbstractValueObject
{    
    private $collection = [];
    
    abstract public function collection_of();
    
    public function __construct(array $items) 
	{
        $this->validate_items($items);
        $this->set_items($items);
	}
    
    protected function validate_items($items) 
    {
        $validator = Validator::instance($this->collection_of());
        foreach ($items as $item) {
            $this->assert()->is($validator, $item);
        }
    }
    
    protected function set_items(array $items)
    {
        foreach ($items as $item) {
            $key = $this->item_key($item);
            $this->collection[$key] = $item;
        }
    }
    
    abstract protected function item_key($item);
    
    public function equals(ValueObject $other_valueobject) 
	{
        $result = $this->is_same_class($other_valueobject);
        if (!$result) {
            return $result;
        }
        foreach ($this->collection as $key=>$valueobject) {
            $result = $result && 
                $valueobject->equals($other_valueobject->collection[$key]);
        }
		return $result;
	}

    public function collection()
    {
        return $this->collection;
    }
}
