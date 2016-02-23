<?php

namespace EventSourced\Serializer\ValueObject;

use EventSourced\ValueObject\AbstractTreeNode;
use EventSourced\Serializer\Serializer;

class TreeNode extends AbstractSerializer
{    
    private $serializer;
    
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }
    
    public function serialize(AbstractTreeNode $object)
    {
        $value_object = $this->get_private_property($object, 'value');
        //var_dump($value_object);
        return [
            'type' => $object->get_type_key(),
            'value' => $this->serializer->serialize($value_object)
        ];
    }
    
    public function deserialize($class, $serialized)
    {
        $value_object_class = $class::get_class_for_type_key($serialized['type']);
        $value_object = $this->serializer->deserialize($value_object_class, $serialized['value']);
        return new $class($value_object);
    }
}


