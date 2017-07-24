<?php namespace EventSourced\ValueObject\ValueObject;

use EventSourced\ValueObject\Contracts\ValueObject\Identifier;
use Rhumsaa\Uuid\Uuid as UuidGenerator;

class Uuid extends Type\AbstractSingleValue implements Identifier
{
    protected function validator()
    {
        return parent::validator()->regex('/([a-f\d]{8}(-[a-f\d]{4}){3}-[a-f\d]{12}?)$/i');
    }

    public function is_null()
    {
        return $this->equals(new Uuid('00000000-0000-0000-0000-000000000000'));
    }

    public static function generate()
    {
        return new Uuid( UuidGenerator::uuid4()->toString() );
    }
}
