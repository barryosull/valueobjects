<?php

namespace EventSourced\Contract;

interface ValueObject 
{
    public function equals(ValueObject $valueobject);
}
