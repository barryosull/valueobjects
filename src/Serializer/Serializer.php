<?php

namespace EventSourced\Serializer;

use EventSourced\Contract;
use EventSourced\ValueObject\AbstractSingleValue;
use EventSourced\ValueObject\AbstractComposite;
use EventSourced\ValueObject\AbstractCollection;
use EventSourced\ValueObject\AbstractTreeNode;

class Serializer implements Contract\Serializer\Serializer, Contract\Serializer\Deserializer 
{
    private $single_value;
    private $composite;
    private $collection;
    private $tree_node;
    
    public function __construct()
    {
        $this->single_value = new ValueObject\SingleValue();
        $this->composite = new ValueObject\Composite($this);
        $this->collection = new ValueObject\Collection($this);
        $this->tree_node = new ValueObject\TreeNode($this);
    }
    
    public function deserialize($class, $parameters)
    {
        $serializer = $this->serializer_repo_fetch($class);
        return $serializer->deserialize($class, $parameters);
    }

    public function serialize($object)
    {
        $serializer = $this->serializer_repo_fetch(get_class($object));
        return $serializer->serialize($object);
    }
    
    private function serializer_repo_fetch($class)
    {
        if ($this->is_instance_of($class, AbstractTreeNode::class)) {
            return $this->tree_node;
        }
        if ($this->is_instance_of($class, AbstractSingleValue::class)) {
            return $this->single_value;
        } 
        if ($this->is_instance_of($class, AbstractComposite::class)) {
            return $this->composite;
        }
        if ($this->is_instance_of($class, AbstractCollection::class)) {
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
