<?php

namespace EventSourced\ValueObject\Extensions\Serializers;

use EventSourced\ValueObject\Contracts\Deserializer;
use EventSourced\ValueObject\Contracts\Serializer;
use EventSourced\ValueObject\Deserializer\Exception;

class Carbon implements Serializer, Deserializer
{
    public function deserialize($class, $value)
    {
        try {
            return new \Carbon\Carbon($value);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function serialize($serializable)
    {
        /**
         * @var \Carbon\Carbon $serializable
         */
        return $serializable->toDateTimeString();
    }
}
