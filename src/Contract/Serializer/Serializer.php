<?php 

namespace EventSourced\Contract\Serializer;

interface Serializer
{
    public function serialize($serializable);
}