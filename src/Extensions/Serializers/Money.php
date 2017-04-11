<?php

namespace EventSourced\ValueObject\Extensions\Serializers;

use EventSourced\ValueObject\Contracts\Deserializer;
use EventSourced\ValueObject\Contracts\Serializer;
use EventSourced\ValueObject\Deserializer\Exception;

class Money implements Serializer, Deserializer
{
    public function deserialize($class, $parameters)
    {
        if (is_array($parameters)) {
            $parameters = (object)$parameters;
        }

        try {
            return new \Money\Money(
                $parameters->amount,
                new \Money\Currency($parameters->currency)
            );
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function serialize($serializable)
    {
        /**
         * @var \Money\Money $serializable
         */
        return [
            'amount' => $serializable->getAmount(),
            'currency' => $serializable->getCurrency()->getCode()
        ];
    }
}
