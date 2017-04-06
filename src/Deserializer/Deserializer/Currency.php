<?php

namespace EventSourced\ValueObject\Deserializer\Deserializer;

use EventSourced\ValueObject\Deserializer\Exception;

class Currency
{
    public function deserialize($class, $serialized)
    {
        try {
            return new \Money\Currency($serialized);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
