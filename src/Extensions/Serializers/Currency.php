<?php

namespace EventSourced\ValueObject\Extensions\Serializers;

use EventSourced\ValueObject\Contracts\Deserializer;
use EventSourced\ValueObject\Contracts\Serializer;
use EventSourced\ValueObject\Deserializer\Exception;

class Currency implements Serializer, Deserializer
{
    public function deserialize($class, $parameters)
    {
        try {
            return new \Money\Currency($parameters);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function serialize($serializable)
    {
        /**
         * @var \Money\Currency $serializable
         */
        return $serializable->getCode();
    }
}
