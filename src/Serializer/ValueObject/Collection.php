<?php

namespace EventSourced\Serializer\ValueObject;

use EventSourced\Serializer\Serializer;
use EventSourced\ValueObject\AbstractCollection;

class Collection extends AbstractSerializer
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
    
    public function deserialize($class, $serialized)
    {
        $collection = new $class([]);
        $collection_of_class = $collection->collection_of();
        foreach ($serialized as $value) {
            $collection = $collection->add( 
                $this->serializer->deserialize($collection_of_class, $value) 
            );
        }
		return $collection;
    }
}
