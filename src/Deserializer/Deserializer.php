<?php namespace EventSourced\ValueObject\Deserializer;

use EventSourced\ValueObject\Contracts;
use EventSourced\ValueObject\Deserializer\Deserializer\MethodArguments;
use EventSourced\ValueObject\Extensions\ExtensionRepository;
use EventSourced\ValueObject\ValueObject\Type;

class Deserializer implements Contracts\Deserializer, Contracts\MethodDeserializer
{
    private $single_value;
    private $composite;
    private $set;
    private $type_entity;
    private $method_arguments;
    private $extensionRepository;

    public function __construct(
        Reflector $reflector,
        ExtensionRepository $repository
    ) {
        $this->single_value = new Deserializer\SingleValue();
        $this->composite = new Deserializer\Composite($this, $reflector);
        $this->set = new Deserializer\Set($this);
        $this->type_entity = new Deserializer\TypeEntity($this, $reflector);
        $this->method_arguments = new MethodArguments($this, $reflector);
        $this->extensionRepository = $repository;
    }
    
    public function deserialize($class, $parameters)
    {
        if ($this->extensionRepository->isExtension($class)) {
            $deserializer = $this->extensionRepository->fetch($class);
        } else {
            $deserializer = $this->deserializer_repo_fetch($class);
        }

        return $deserializer->deserialize($class, $parameters);
    }
 
    private function deserializer_repo_fetch($class)
    {
        if ($this->is_instance_of($class, Type\AbstractTypeEntity::class)) {
            return $this->type_entity;
        }
        if ($this->is_instance_of($class, Type\AbstractSingleValue::class)) {
            return $this->single_value;
        } 
        if ($this->is_instance_of($class, Type\AbstractComposite::class)) {
            return $this->composite;
        }
        if ($this->is_instance_of($class, Type\AbstractSet::class)) {
            return $this->set;
        }
        
        throw new \Exception("No deserializer found for class ".$class);
    }
    
    private function is_instance_of($class, $parent_class)
    {
        return is_subclass_of($class, $parent_class)
            || ($class == $parent_class);
    }

    public function deserializeMethod($object, $method, $serialized_parameters)
    {
        $arguments = $this->method_arguments->deserialize(get_class($object), $method, $serialized_parameters);

        return new Method($object, $method, $arguments);
    }
}
