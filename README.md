# ValueObjects

ValueObjects (VOs) are the core of any DDD app, they ensure that values are valid and that they can be accepted by your domain.

In our experience, most ValueObject libraries offer a collection of ValueObjects, but have locked things down, so it's hard to extend them and build new ones.

That's why we've built this ValueObjects toolkit, it makes building new ValueObjects quick, easy and painless.

## ValueObjects and Validators

### Single Values
These are ValueObjects that are given a single value that they must validate. For these ValueObjects all you need to do is specify their validator class.

#### Making a new Single Value VO
```php
use EventSourced\ValueObject;
use EventSourced\Validator;

class Integer extends ValueObject\AbstractSingleValue 
{    
    protected function validator()
    {
        return new Validator\Integer();
    }
}
```

### Validators
Validators make sure that values are, well, valid. They're very simples classes and they're easy to make. 

#### Making a new validator
```php
use EventSourced\Validator;

class Float extends Validator\AbstractValidator
{    
    public function is_satisfied_by($value)
    {
        return is_numeric($value);
    }
}
```

### Chaining Validators
Validators are designed to be chained together to form more complex validators. This is done via the specification pattern, so building a new validator from existing validators is incredibly easy.

#### Making a ValueObject from multiple validators
```php
use EventSourced\ValueObject;
use EventSourced\Validator;

class Coordinate extends ValueObject\AbstractSingleValue 
{    
    protected function validator()
    {
        return (new Validator\Float())
            ->and_x(new Validator\GreaterThanOrEqual(-90))
            ->and_x(new Validator\LessThanOrEqual(90));
    }
}
```

### Composite ValueObjects
These are ValueObjects that are made from two or more ValueObjects. They are a composite that represents the pairing of the ValueObjects.
An example is a locations GPS coordinate, it's actually a composite of two Coordinates, latitude and longitude.

#### Making a composite ValueObject
```php
use EventSourced\ValueObject;

class GPSCoordinates extends ValueObject\AbstractComposite 
{   
    public function __construct(Coordinate $latitude, Coordinate $longitude) 
    {
        parent::__construct($latitude, $longitude);
    }
}
```
That's it, the base class figures out the rest.

### Enum validators
Enums are fairly common, so we've added a base class that makes creating them incredibly easy.
```php
use EventSourced\ValueObject;

class TemperatureScale extends ValueObject\AbstractEnum {
    
    protected function enums() {
        return [
          'c',
          'f'
        ];
    }
}
```

### Comparing
Comparing ValueObjects is easy. Just use the built in equals function. You get this out of the box if you extend the "AbstractSingleValue" or "AbstractComposite" classes.
```php
$float_a = new Float(0.121);
$float_b = new Float(0.121);
$same = $float_a->equals($float_b);
```

### Serializing
Our ValueObjects are intended to be used as part of our event sourcing framework, so it's important that ValueObjects and be serialized and deserialized.
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
use EventSourced\Validator;

class EmailAddress extends Validator\AbstractZend
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

That's not to say it doesn't report what went wrong. Invalid VOs automatically return an exception that includes the ValueObjects class and the value that caused the crash.
This makes it easy to repeat the error and figure out exactly what went wrong.

#### Accessing Validation errors
```php
try {
    new ValueObject\Coordinate(90.00001);
} catch (Assert\IsException $ex) {
    $exception->value();
    $exception->valueobject_class();
}
```
