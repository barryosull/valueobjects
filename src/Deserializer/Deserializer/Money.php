<?php

namespace EventSourced\ValueObject\Deserializer\Deserializer;

use EventSourced\ValueObject\Deserializer\Exception;

class Money
{
    public function deserialize($class, $serialized)
    {
        if (is_array($serialized)) {
            $serialized = (object)$serialized;
        }

        try {
            return new \Money\Money(
                $serialized->amount,
                new \Money\Currency($serialized->currency)
            );
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
