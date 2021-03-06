<?php namespace EventSourced\ValueObject\Deserializer\Deserializer;

use EventSourced\ValueObject\Deserializer\Deserializer;
use EventSourced\ValueObject\Deserializer\Reflector;

class Composite
{
    private $deserializer;
    private $reflector;

    public function __construct(Deserializer $deserializer, Reflector $reflector)
    {
        $this->deserializer = $deserializer;
        $this->reflector = $reflector;
    }

    public function deserialize($class, $serialized)
    {
        $parameters_deserializer = new Parameters($this->deserializer);

        $reflection_parameters = $this->reflector->get_constructor_parameters($class);

        $parameters = $parameters_deserializer->deserialize($reflection_parameters, $serialized);

        return $this->reflector->call_constructor($class, $parameters);
    }
}
