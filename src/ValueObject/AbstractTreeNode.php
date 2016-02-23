<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

abstract class AbstractTreeNode extends AbstractSingleValue
{  
    static protected function accepts()
    {
        return [];
    }
     
    public static function get_class_for_type_key($type_key)
    {
        return static::accepts()[$type_key];
    }
    
    public function get_type_key()
    {
        return $this->type_key;
    }
    
    protected function validator() 
    {
        $validators = [];
        foreach (static::accepts() as $class) {
            $validators[] = Validator::instance($class);
        }
        return Validator::oneOf(...$validators);
    }
    
    private $type_key;
    
    public function __construct($value)
    {
        parent::__construct($value);
        $this->type_key = array_search(get_class($value), static::accepts());
    }
}