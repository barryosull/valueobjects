<?php

use EventSourced\Assert;
use EventSourced\ValueObject\UUID;
use EventSourced\ValueObject\DateTime;
use EventSourced\ValueObject\SampleEntity;

class TestSampleEntity extends \PHPUnit_Framework_TestCase 
{
    private $entity;
    
    public function setUp()
    {
        $this->entity = new SampleEntity(new UUID("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8"), new DateTime('2012-01-20'));
    }
        
    public function test_access_value() 
    {
        $this->assertTrue($this->entity->datetime->equals(new DateTime('2012-01-20')));
    }
    
    public function test_change_value()            
    {
        $date = new DateTime('2014-01-21');
        $this->entity->datetime = $date;
        $this->assertTrue($this->entity->datetime->equals($date));
    }
    
    public function test_entity_equality_is_based_only_on_id()
    {
        $entity_2 = new SampleEntity(new UUID("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8"), new DateTime('2014-01-20'));
        $this->assertTrue($this->entity->equals($entity_2));
    }
    
}