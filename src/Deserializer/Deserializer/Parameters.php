<?php namespace EventSourced\ValueObject\Deserializer\Deserializer;

use EventSourced\ValueObject\Deserializer\Deserializer;
use EventSourced\ValueObject\Deserializer\Exception;
use EventSourced\ValueObject\Assert\Exception as AssertException;

class Parameters
{
    private $deserializer;

    public function __construct(Deserializer $deserializer)
    {
        $this->deserializer = $deserializer;
    }

    public function deserialize($reflection_parameters, $serialized)
    {
        if (is_array($serialized)) {
            $serialized = (object)$serialized;
        }

        $errors = [];
        $deserialized_parameters = [];

        foreach ($reflection_parameters as $parameter) {
            $name = $parameter->getName();

            try {
                $deserialized_parameters[$name] = $this->make_parameter($parameter, $serialized);
            } catch (AssertException $e) {
                $errors[$name] = $e->error_messages();
            } catch (Exception $e) {
                $errors[$name] = $e->error_messages();
            }
        }

        if (count($errors) != 0) {
            throw new Exception($errors);
        }

        return $deserialized_parameters;
    }

    private function make_parameter($parameter, $serialized)
    {
        $name = $parameter->getName();
        $parameter_class = $parameter->getClass()->getName();

        if ($this->is_nullable_parameter($parameter) && is_null($serialized)) {
            return null;
        }

        if (!property_exists($serialized, $name)) {
            throw new Exception(["Property '$name' is missing"]);
        }

        return $this->deserializer->deserialize(
            $parameter_class, $serialized->$name
        );
    }

    private function is_nullable_parameter(\ReflectionParameter $parameter)
    {
        return ($parameter->isOptional() && $parameter->getDefaultValue() === null);
    }
}