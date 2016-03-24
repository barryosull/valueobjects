<?php

namespace EventSourced\Serializer\Serializer;

use EventSourced\ValueObject\Type\AbstractTreeNode;
use EventSourced\Serializer\Serializer;
use EventSourced\Serializer\Reflector;

class TreeNode
{    
    private $serializer;
    private $reflector;
    
    public function __construct(Serializer $serializer, Reflector $reflector)
    {
        $this->reflector = $reflector;
        $this->serializer = $serializer;
    }
    
    public function serialize(AbstractTreeNode $object)
    {
        $value_object = $this->reflector->get_private_property($object, 'value');
        return [
            'type' => $object->get_type_key(),
            'value' => $this->serializer->serialize($value_object)
        ];
    }
}


