<?php namespace EventSourced\ValueObject\ValueObject\Type;

use EventSourced\ValueObject\Contracts\ValueObject;

abstract class AbstractTypeEntity extends AbstractEntity
{
    static protected function accepts()
    {
        throw new \Exception("No values accepted for this type, please override this function and return an array mapping the type value to the type class path");
    }

    public static function get_class_for_type_key($type_key)
    {
        return static::accepts()[$type_key];
    }

    public static function variable_property_key()
    {
        throw new \Exception("No variable property defined for this type, please override this function and return the name of the property that contains the variable valueobject.");
    }

    protected function assert_valid_type(AbstractSingleValue $type, ValueObject $value)
    {
        $type_key = $type->value();
        if (!isset(static::accepts()[$type_key])) {
            throw new \Exception("Unknown type '$type_key', unable to process.");
        }
        if (static::accepts()[$type_key] != get_class($value)) {
            throw new \Exception("Invalid type '$type_key', for object '".get_class($value)."'");
        }
    }
}