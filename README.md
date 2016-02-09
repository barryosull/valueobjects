# ValueObjects

ValueObjects (VOs) are the core of any DDD app, they ensure that values are valid and that they can be accepted by your domain.

In our experience, most ValueObject libraries offer a collection of ValueObjects, but have locked things down, so it's hard to extend them and build new ones.

That's why we've built this valueobjects toolkit, it makes building new ValueObjects quick, easy and painless.

## ValueObjects and Validators

### Single Values
These are valueobjects that are given a single value that they must validate. For these ValueObjects all you need to do is specify their validator class.

#### Making a new Single Value VO
```php
class Integer extends AbstractSingleValue 
{    
    protected function validator_class()
    {
        return Validator\Integer::class;
    }
}
```

### Validators
Validators make sure that values are, well, valid. They're very simples classes and they're easy to make. 

#### Making a new validator
```php
class Float extends AbstractComposite
{    
    public function is_satisfied_by($arguments)
    {
        return is_numeric($arguments[0]);
    }
}
```

### Chaining Validators
Validators are designed to be chained together to form more complex validators. This is done via the specification patterns, so building a new validator from existing validators is incredibly easy.

#### Making a validator from existing validators
```php
class Coordinate extends AbstractWrapper
{
    public function compostite_validator()
    {
        return (new Validator\Float())
            ->and_x(new Validator\GreaterThanOrEqual(-90))
            ->and_x(new Validator\LessThanOrEqual(90));
    }
}
```

### Composite ValueObjects
These are valueobjects that are made from two or more valueobjects. They are a composite that represents the pairing of the ValueObjects.
An example is a locations GPS coordinate, it's actually a composite of two Coordinates, latitude and longitude.

#### Making a composite ValueObject
```php
class GPSCoordinates extends AbstractComposite 
{   
    public function __construct(Coordinate $latitude, Coordinate $longitude) 
	{
        parent::__construct($latitude, $longitude);
    }
}
```
That's it, the base class figures out the test.

### Enum validators
Enums are fairly common, so we've added a base class that makes creating them incredibly easy.
```php

class TemperatureScale extends AbstractEnum {
    
    protected function enums() {
        return [
          'c',
          'f'
        ];
    }
}
```

### Comparing
Comparing valueobjects is easy. Just use the built in equals function. You get this out of the box if you extend the "AbstractSingleValue" or "AbstractComposite" classes.
```php
$float_a = new Float(0.121);
$float_b = new Float(0.121);
$same = $float_a->equals($float_b);
```

### Serializing
Our valueobjects are intended to be used as part of our event sourcing framework, so it's important that valueobjects and be serialized and deserialized.
Thankfully, our abstract classes provide this functionality out of the box, so you don't have to worry. Simply extends those classes, and you have that functionality.
```php
$float = new Float(0.121);
$serialized = $float->serialize();
```

### Deserializing
Once you've serialized a ValueObject, you'll want to deserialize it. To do that, pass the serialized result to the status deserialize function, and you'll get the full ValueObject back.
```php
$float = new Float(0.121);
$serialized = $float->serialize();
$float_again = Float::deserialize($serialized);
```

### Zend Validators
There's no point reinventing the wheel, so we've made it easy to use existing validator libraries, in this case, the Zend Framework.
```php
class EmailAddress extends AbstractZend
{ 
    public function __construct() 
    {
        parent::__construct(new \Zend\Validator\EmailAddress());
    }
}
```

### Error Messages
One thing you've probably noticed, we haven't said anything about error messages that report to the user on what went wrong.
Well, there's a reason. ValueObjects are not error reporters, they are not intended to return human readable errors.

There are may reasons for this, but the main one is that error messages are usually application specific, it's next to impossible to write generic error messages that are usable in every context.
So we didn't try to solve that problem, instead we focussed on making the ValueObjects act as guards against bad input, it's the applications responsibility to not send bad data and to report errors in a context sensitive manner.

That's not to say it doesn't report what went wrong. Invalid VOs automatically return an exception that includes the valueobject class, the values that caused the crash and the validator class that it failed on.
This makes it easy to repeat the error and figure out exactly what went wrong.

#### Accessing Validation errors
```php
try {
    new Coordinate(90.00001);
} catch (Assert\IsException $ex) {
    $exception->invariant_class();
    $exception->invariant_arguments();
    $exception->calling_class();
}
```
