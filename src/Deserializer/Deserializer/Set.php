<?php

namespace EventSourced\ValueObject\Deserializer\Deserializer;

use EventSourced\ValueObject\Deserializer\Deserializer;

class Set
{    
    private $deserializer;
    
    public function __construct(Deserializer $deserializer)
    {
        $this->deserializer = $deserializer;
    }
    
    public function deserialize($class, $serialized)
    {
        $collection = new $class([]);
        $collection_of_class = $collection->collection_of();
        foreach ($serialized as $value) {
            $collection = $collection->add( 
                $this->deserializer->deserialize($collection_of_class, $value) 
            );
        }
		return $collection;
    }
}
