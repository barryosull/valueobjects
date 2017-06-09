<?php namespace EventSourced\ValueObject\Contracts;

interface MethodDeserializer
{
    public function deserializeMethod($object, $method, $parameters);
}