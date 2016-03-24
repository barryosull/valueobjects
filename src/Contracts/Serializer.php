<?php 

namespace EventSourced\ValueObject\Contracts;

interface Serializer
{
    public function serialize($serializable);
}