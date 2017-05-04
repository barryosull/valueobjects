<?php

namespace EventSourced\ValueObject\ValueObject\Type;

use EventSourced\ValueObject\Contracts\ValueObject;

abstract class AbstractComposite extends AbstractValueObject
{  
    public function equals(ValueObject $other_valueobject) 
	{
        if (!$this->is_same_class($other_valueobject)) {
            return false;
        }

        foreach ($this as $key=>$valueobject) {
            if (!$this->vos_are_eqauls($valueobject, $other_valueobject->$key)) {
                return false;
            }
        }
		return true;
	}

	private function vos_are_eqauls($valueobect_a, $valueobect_b)
    {
        if ($valueobect_a === null) {
            return ($valueobect_b === null);
        }

        return $valueobect_a->equals($valueobect_b);
    }

    public function is_null()
    {
        foreach ($this as $key=>$valueobject) {
            if ($valueobject !== null) {
                return false;
            }
        }
        return true;
    }
}