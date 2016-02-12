<?php 

namespace EventSourced\Contract\Serializer;

interface Deserializer
{
    public function deserialize($class, $parameters);
}