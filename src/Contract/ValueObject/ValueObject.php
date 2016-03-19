<?php

namespace EventSourced\Contract\ValueObject;

interface ValueObject 
{
    public function equals(ValueObject $valueobject);
}
