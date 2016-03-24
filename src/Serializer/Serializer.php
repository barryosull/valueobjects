<?php

namespace EventSourced\ValueObject\Serializer;

use EventSourced\ValueObject\Contracts;
use EventSourced\ValueObject\ValueObject\Type;

class Serializer implements Contracts\Serializer
{
    private $single_value;
    private $composite;
    private $collection;
    private $tree_node;
    
    public function __construct(Reflector $reflector)
    {
        $this->single_value = new Serializer\SingleValue($reflector);
        $this->composite = new Serializer\Composite($this, $reflector);
        $this->collection = new Serializer\Collection($this);
        $this->tree_node = new Serializer\TreeNode($this, $reflector);
    }

    public function serialize($object)
    {
        $serializer = $this->serializer_repo_fetch(get_class($object));
        return $serializer->serialize($object);
    }
    
    private function serializer_repo_fetch($class)
    {
        if ($this->is_instance_of($class, Type\AbstractTreeNode::class)) {
            return $this->tree_node;
        }
        if ($this->is_instance_of($class, Type\AbstractSingleValue::class)) {
            return $this->single_value;
        } 
        if ($this->is_instance_of($class, Type\AbstractComposite::class)) {
            return $this->composite;
        }
        if ($this->is_instance_of($class, Type\AbstractCollection::class)) {
            return $this->collection;
        }
        
        throw new \Exception("No serializer found for class ".$class);
    }
    
    private function is_instance_of($class, $class_or_interface) 
    {
        return (is_subclass_of($class, $class_or_interface)
            || $class == $class_or_interface);
    }
}
