<?php 

namespace EventSourced\Contract;

interface Deserializer
{
    public function deserialize($class, $parameters);
}