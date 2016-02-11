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
use Respect\Validation\Validator;

class Integer extends ValueObject\AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator::intVal();
    }
}
```

### Validators
ValueObjects use validators to do their job. Instead of writing our own library, we've decided to use the excellent (Respect Validation)[http://respect.github.io/Validation/] library. It has all the validators you could ask for, and it's syntax is concise and elegant.

### Chaining Validators
Respect Validators are chainable, so building complex validators for your value objects is a piece of cake.
```php
use EventSourced\ValueObject;
use Respect\Validation\Validator;

class Coordinate extends ValueObject\AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator::floatVal()->between(-90, 90);
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

### Collections
Sometimes you'll want to have a collection of ValueObjects. Now, you can't use a standard array, because the deserializer has to know what type of ValueObject is in the collection. That's why we created a simple helper class for creating strongly typed collections of ValueObjects.
```php
namespace EventSourced\ValueObject;

class IntegerCollection extends AbstractCollection 
{    
    protected function collection_of_class()
    {
        return Integer::class;
    }
}
```
You just need to define the "collection_of_class" and return the class type of the collection. The base class will ensure that all items added to the list are of the correct type.

### Ordered Collections
Occasionally you'll want to define an ordered collection, one where the sequence is important. Here's how to do that using our helper abstract class "AbstractOrderedCollection".
```php
use Respect\Validation\Validator;

class AscendingIntegerCollection  extends AbstractOrderedCollection 
{    
    protected function collection_of_class()
    {
        return Integer::class;
    }
    
    protected function order_validator($preceding_value)
    {
       return Validator::floatVal()->min($preceding_value);
    }
}
```
Implement those two methods and you'll have a list that's ordered by the result of a validator, comparing each element to the one next to it.

### Comparing
Comparing ValueObjects is easy. Just use the built in equals function. You get this out of the box if you extend any of the abstract classes (except AbstractValueObject).
```php
$float_a = new Float(0.121);
$float_b = new Float(0.121);
$same = $float_a->equals($float_b);
```

### Serializing
Our ValueObjects are intended to be used as part of our event sourcing framework, so it's important that ValueObjects can be serialized and deserialized.
Thankfully, our abstract classes provide this functionality out of the box, so you don't have to worry. Simply extends those classes, and you have that functionality.
```php
$float = new Float(0.121);
$serialized = $float->serialize();
```

### Deserializing
Once you've serialized a ValueObject, you'll want to deserialize it at some future time. To do that, pass the serialized result to the static deserialize function, and you'll get the full ValueObject back.
```php
$float = new Float(0.121);
$serialized = $float->serialize();
$float_again = Float::deserialize($serialized);
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
