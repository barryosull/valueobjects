<?php

namespace EventSourced\ValueObject\Serializer\Serializer;

use EventSourced\ValueObject\Serializer\Serializer;
use EventSourced\ValueObject\ValueObject\Type\AbstractCollection;

class Collection
{    
    private $serializer;
    
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }
    
    public function serialize(AbstractCollection $object)
    {
        $collection = $object->collection();
        $serialized = array_map(function($item){
            return $this->serializer->serialize($item);
        }, $collection);
		return array_values($serialized);
    }
}
