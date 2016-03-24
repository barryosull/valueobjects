<?php

namespace EventSourced\ValueObject\Contracts;

interface ValueObject 
{
    public function equals(ValueObject $valueobject);
}
