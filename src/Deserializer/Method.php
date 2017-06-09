<?php namespace EventSourced\ValueObject\Deserializer;

class Method
{
    private $object;
    private $method;
    private $parameters;

    public function __construct($object, $method, $parameters)
    {
        $this->object = $object;
        $this->method = $method;
        $this->parameters = $parameters;
    }

    public function run()
    {
        $class = get_class($this->object);
        $reflectionMethod = new \ReflectionMethod($class, $this->method);
        return $reflectionMethod->invokeArgs($this->object, $this->parameters);
    }
}