<?php 

namespace EventSourced\Contract;

interface Serializer
{
    public function serialize($serializable);
}