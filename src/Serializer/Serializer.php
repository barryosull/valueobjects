<?php

namespace EventSourced\ValueObject\Serializer;

use EventSourced\ValueObject\Contracts;
use EventSourced\ValueObject\ValueObject\Type;

class Serializer implements Contracts\Serializer
{
    private $single_value;
    private $composite;
    private $set;
    private $money;
    private $currency;
    
    public function __construct(Reflector $reflector)
    {
        $this->single_value = new Serializer\SingleValue();
        $this->composite = new Serializer\Composite($this, $reflector);
        $this->set = new Serializer\Set($this);
        $this->money = new Serializer\Money();
        $this->currency = new Serializer\Currency();
    }

    public function serialize($object)
    {
        $serializer = $this->serializer_repo_fetch(get_class($object), $object);
        return $serializer->serialize($object);
    }
    
    private function serializer_repo_fetch($class, $object)
    {
        if ($this->is_instance_of($class, Type\AbstractTypeEntity::class)) {
            return $this->composite;
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
        if ($this->is_instance_of($class, \Money\Money::class)) {
            return $this->money;
        }
        if ($this->is_instance_of($class, \Money\Currency::class)) {
            return $this->currency;
        }
        throw new Exception("No serializer found for class '".$class."'");
    }

    private function is_instance_of($class, $parent_class)
    {
        return is_subclass_of($class, $parent_class)
        || ($class == $parent_class);
    }
}
