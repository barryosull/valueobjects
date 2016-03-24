<?php

namespace EventSourced\Serializer\Serializer;

use EventSourced\Serializer\Serializer;
use EventSourced\ValueObject\Type\AbstractCollection;

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
