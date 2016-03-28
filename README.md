# ValueObjects

ValueObjects (VOs) are the core of any DDD (Domain Driven Design) application, they ensure that values are valid and will be accepted by your domain.

In our experience, most ValueObject libraries offer a collection of ValueObjects, but they've locked them down, so it's hard to extend them and build new ones.

That's why we've built this ValueObjects toolkit, it makes building new ValueObjects quick, easy and painless. 

For those using an onion architecture, consider this libary as part of the core.

## ValueObjects and Validators

### Single Values
These are ValueObjects that are given a single value that they must validate. For these ValueObjects all you need to do is specify their validator by extending the parent.

#### Making a new Single Value VO
```php
use EventSourced\ValueObject\ValueObject;

class Integer extends ValueObject\AbstractSingleValue 
{    
    protected function validator()
    {
        return parent::validator()->intVal();
    }
}
```
#### Accessing the value
If you want to access the value held within a single ValueObject, then do the following.
```php
$integer = new Integer(1);
echo $integer->value();
```
Nice and easy.

### Validators
ValueObjects use validators to do their job. Instead of writing our own library, we've decided to use the excellent [Respect Validation](http://respect.github.io/Validation/) library. It has all the validators you could ask for, and it's syntax is concise and elegant.

A helper method "validator" returns a new instance of the respect validator, it has been added to all abstract classes.

### Chaining Validators
Respect Validators are chainable, so building complex validators for your value objects is a piece of cake.
```php
use EventSourced\ValueObject\ValueObject\Type\AbstractSingleValue;

class Coordinate extends AbstractSingleValue 
{    
    protected function validator()
    {
        return parent::validator()->floatVal()->between(-90, 90);
    }
}
```

### Composite ValueObjects
These are ValueObjects that are made from two or more ValueObjects. They are a composite that represents the pairing of the ValueObjects.
An example is a locations GPS coordinate, it's actually a composite of two Coordinates, latitude and longitude.

#### Making a composite ValueObject
```php
use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;

class GPSCoordinates extends AbstractComposite 
{   
    protected $latitude;
    protected $longitude;
    
    public function __construct(Coordinate $latitude, Coordinate $longitude) 
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
    
    public function latitude()
    {
        return $this->latitude;
    }
    
    public function longitude()
    {
        return $this->longitude;
    }
}
```
So it's simply just a holder for a bunch of valueobjects. If you want to run any validation across value objects, you should do it in the constructor. The base class takes care of the "equals" method, so you don't have to worry about that.

### Collections
Sometimes you'll want to have a collection of ValueObjects. Now, you shouldn't use a standard array, because you want strong typing (also the deserializer has to know what type of ValueObject is in the collection, more on that later). That's why we created a simple helper class for creating strongly typed collections of ValueObjects.
```php
use EventSourced\ValueObject\ValueObject\Type\AbstractCollection;

class IntegerCollection extends AbstractCollection 
{    
    public function collection_of()
    {
        return Integer::class;
    }
}
```
You just need to define the "collection_of" and return the class type of the collection. The base class will ensure that all items added to the list are of the correct type. Collections allow you to perform various operations on the collection, such as the following. Collections are immutable, so any operations on it will return a new collection, leaving the original intact.

```php
$collection = new IntegerCollection([new Integer(1)]);
$collection = $collection->add(new Integer(2)); 
$collection->count(); //2
$collection->exists(new Integer(2)); //true
$collection->get(0)->value(); //1
$collection = $collection->remove(new Integer(2));
$collection->exists(new Integer(2)); //false
```

### Entities
An entity is a composite valueobject, where the first value is the ID of the entity, and the rest of the values are just values. The key thing about an identity is that it is "equal" to another entity if the IDs match, the rest of the values don't matter for comparisons.

The ID valueobject must implement the "Identifier" contract, the reason for this is to make intent clear, so you don't accidentily pass the wrong ValueObject to the parent constructor.

```php
use EventSourced\ValueObject\ValueObject\Type\AbstractEntity;

class SampleEntity extends AbstractEntity
{
    public $date;
    
    //Uuid and Date are base types that comes with the library
    public function __construct(Uuid $id, Date $date) 
    {
        $this->date = $date;
        parent::__construct($id);
    }
}

$entity = new SampleEntity(new Uuid("153111a5-2d77-48b7-a88d-ee1d626c1d5d"), new Date('2013-10-12');

//Accessing the id property, part of the base class
echo $entity->id()->value();
```

That's an entity. You'll notice that the value "$date" is public. That's because it's an entity and the values can change. Feel free to make this protected, it would be better, the above is just for brevity.

### Index
An index is a collection of entities, where the id of the entity is used as the key for the collection. Entities are accessed and removed by their ID. Creating one is as simple as creating a collection.

```php
use EventSourced\ValueObject\ValueObject\Type\AbstractIndex;

class SampleEntityIndex extends Type\AbstractIndex
{    
    public function collection_of()
    {
        return SampleEntity::class;
    }
}
```

Indexes have similar functionality to collections, except the focus is around entities and their ids. Here is the full feature set.

```php
$index = new SampleEntityIndex([]);
$id = new Uuid("153111a5-2d77-48b7-a88d-ee1d626c1d5d");
$index = $index->add(new SampleEntity($id, new Date('2013-10-12'))); 
$index->count(); //1
$index->exists($id); //true
$index->get($id)->date()->value(); //'2013-10-12'
$index = $index->replace(new SampleEntity($id, new Date('2014-10-12'));
$index->get($id)->date()->value(); //'2014-10-12'
$index = $index->remove($id);
$index->exists($id); //false
```

### Comparing
Comparing ValueObjects is easy. Just use the built in equals function. You get this out of the box if you extend any of the above abstract classes. If all the values match, then they are equal (Entities being the exception, only the "id" matters for comparison).
```php
$float_a = new Float(0.121);
$float_b = new Float(0.121);
$float_a->equals($float_b); //true
```

### Serializing
As you've seen above, you can access the value of any value object and you can navigate complex valueobjects to extract their tree structure. This means you can serialize a value object and store it in a Datebase to deserialize and use later. 

Now, the thing is, writing these serializers is a pain in the ass. That's why we've created generic serializer/deserializer classes that tranforms these ValueObjects into their base data structures, and back. This serializer wil only work with our abstract classes, so if you extend those, then you can serialize a ValueObject.


For AbstractSingleValue based ValueObjects, it returns the base value, for AbstractComposite and the more complex ValueObjects, it returns the tree structure as an array with key => values. Here's how it works.
```php
use EventSourced\ValueObject\Serializer\Serializer;

$float = new Float(0.121);
$serializer = new Serializer();
$serialized = $serializer->serialize($float);
```

### Deserializing
Once you've serialized a ValueObject, you'll want to deserialize it at some future time. To do that, pass the serialized result to the deserialize function, type hinting the ValueObject class you want it to recreate, and you'll get the full ValueObject back. This works for simple and complex, such as collections and indexes.
```php
use EventSourced\ValueObject\Serializer\Serializer;
use EventSourced\ValueObject\Deserializer\Deserializer;

$float = new Float(0.121);
$serializer = new Serializer();
$serialized = $serializer->serialize($float);

$deserializer = new Deserializer();
$float_again = $deserializer->deserialize(Float:class, $serialized);
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
