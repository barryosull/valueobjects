<?php namespace Test\Serializer\EntityNode;

use EventSourced\ValueObject\ValueObject\Type\AbstractTypeEntity;
use EventSourced\ValueObject\ValueObject\Uuid;
use EventSourced\ValueObject\Contracts\ValueObject;

class Vehicle extends AbstractTypeEntity
{
    protected $max_speed;
    protected $type;
    protected $details;

    public function __construct(Uuid $id, MaxSpeed $max_speed, Type $type, ValueObject $details)
    {
        parent::__construct($id);
        $this->max_speed = $max_speed;
        $this->type = $type;
        $this->details = $details;
        $this->assert_valid_type($type, $details);
    }

    static protected function accepts()
    {
        return [
            'bike' => Bike::class,
            'car' => Car::class
        ];
    }

    public static function variable_property_key()
    {
        return 'details';
    }
}