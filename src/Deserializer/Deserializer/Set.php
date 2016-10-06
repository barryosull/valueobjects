<?php namespace EventSourced\ValueObject\Deserializer\Deserializer;

use EventSourced\ValueObject\Deserializer\Deserializer;
use EventSourced\ValueObject\Deserializer\Exception;
use EventSourced\ValueObject\Assert;

class Set
{
    private $deserializer;

    public function __construct(Deserializer $deserializer)
    {
        $this->deserializer = $deserializer;
    }

    public function deserialize($class, $serialized)
    {
        $errors = [];
        $collection = new $class([]);
        $collection_of_class = $collection->collection_of();
        foreach ($serialized as $key=>$value) {
            try {
                $collection = $collection->add(
                    $this->deserializer->deserialize($collection_of_class, $value)
                );
            } catch (Assert\Exception $e) {
                $errors[$key] = $e->error_messages();
            } catch (Exception $e) {
                $errors[$key] = $e->error_messages();
            }
        }
        if (count($errors) != 0) {
            throw new Exception($errors);
        }
        return $collection;
    }
}
