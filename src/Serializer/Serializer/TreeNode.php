<?php

namespace EventSourced\ValueObject\Serializer\Serializer;

use EventSourced\ValueObject\ValueObject\Type\AbstractTreeNode;
use EventSourced\ValueObject\Serializer\Serializer;
use EventSourced\ValueObject\Serializer\Reflector;

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
        $value_object = $object->value();
        return [
            'type' => $object->get_type_key(),
            'value' => $this->serializer->serialize($value_object)
        ];
    }
}


