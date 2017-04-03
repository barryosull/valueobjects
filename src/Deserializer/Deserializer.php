<?php namespace EventSourced\ValueObject\Deserializer;

use EventSourced\ValueObject\Contracts;
use EventSourced\ValueObject\ValueObject\Type;

class Deserializer implements Contracts\Deserializer 
{
    private $single_value;
    private $composite;
    private $set;
    private $type_entity;
    private $money;
    
    public function __construct(Reflector $reflector)
    {
        $this->single_value = new Deserializer\SingleValue();
        $this->composite = new Deserializer\Composite($this, $reflector);
        $this->set = new Deserializer\Set($this);
        $this->type_entity = new Deserializer\TypeEntity($this, $reflector);
        $this->money = new Deserializer\Money();
    }
    
    public function deserialize($class, $parameters)
    {
        $deserializer = $this->deserializer_repo_fetch($class);
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
        if ($this->is_instance_of($class, \Money\Money::class)) {
            return $this->money;
        }
        
        throw new \Exception("No deserializer found for class ".$class);
    }
    
    private function is_instance_of($class, $parent_class)
    {
        return is_subclass_of($class, $parent_class)
            || ($class == $parent_class);
    }
}
