<?php 

namespace EventSourced\ValueObject\Contracts;

interface Deserializer
{
    public function deserialize($class, $parameters);
}