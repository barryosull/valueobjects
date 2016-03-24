<?php 

namespace EventSourced\ValueObject\Contracts\ValueObject;

use EventSourced\ValueObject\Contracts\ValueObject;

interface Identifier extends ValueObject
{
    /**
     * Returns a boolean to evaluate whether the current Identifier is null.
     *
     * @return boolean
     */
    public function is_null();
}
