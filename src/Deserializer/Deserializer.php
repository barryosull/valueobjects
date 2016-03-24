<?php

namespace EventSourced\ValueObject\Deserializer;

use EventSourced\ValueObject\Contracts;
use EventSourced\ValueObject\ValueObject\Type;

class Deserializer implements Contracts\Deserializer 
{
    private $single_value;
    private $composite;
    private $collection;
    private $tree_node;
    
    public function __construct(Reflector $reflector)
    {
        $this->single_value = new Deserializer\SingleValue();
        $this->composite = new Deserializer\Composite($this, $reflector);
        $this->collection = new Deserializer\Collection($this);
        $this->tree_node = new Deserializer\TreeNode($this);
    }
    
    public function deserialize($class, $parameters)
    {
        $serializer = $this->deserializer_repo_fetch($class);
        return $serializer->deserialize($class, $parameters);
    }
 
    private function deserializer_repo_fetch($class)
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
        
        throw new \Exception("No deserializer found for class ".$class);
    }
    
    private function is_instance_of($class, $class_or_interface) 
    {
        return (is_subclass_of($class, $class_or_interface)
            || $class == $class_or_interface);
    }
}
