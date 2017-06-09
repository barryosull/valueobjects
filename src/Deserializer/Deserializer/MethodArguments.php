<?php namespace EventSourced\ValueObject\Deserializer\Deserializer;

use EventSourced\ValueObject\Deserializer\Deserializer;
use EventSourced\ValueObject\Deserializer\Reflector;

class MethodArguments
{
    private $deserializer;
    private $reflector;

    public function __construct(Deserializer $deserializer, Reflector $reflector)
    {
        $this->deserializer = $deserializer;
        $this->reflector = $reflector;
    }

    public function deserialize($class, $method, $serialized)
    {
        $reflection_parameters = new Parameters($this->deserializer);

        $parameters = $this->reflector->get_method_parameters($class, $method);

        return $reflection_parameters->deserialize($parameters, $serialized);
    }
}
