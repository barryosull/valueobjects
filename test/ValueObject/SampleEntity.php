<?php

use EventSourced\ValueObject\ValueObject\Uuid;
use EventSourced\ValueObject\ValueObject\Date;
use EventSourced\ValueObject\ValueObject\SampleEntity;

class TestSampleEntity extends \PHPUnit_Framework_TestCase 
{
    private $entity;
    
    public function setUp()
    {
        $this->entity = new SampleEntity(new Uuid("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8"), new Date('2012-01-20'));
    }
        
    public function test_access_value() 
    {
        $this->assertTrue($this->entity->date->equals(new Date('2012-01-20')));
    }
    
    public function test_change_value()            
    {
        $date = new Date('2014-01-21');
        $this->entity->date = $date;
        $this->assertTrue($this->entity->date->equals($date));
    }
    
    public function test_entity_equality_is_based_only_on_id()
    {
        $entity_2 = new SampleEntity(new Uuid("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8"), new Date('2014-01-20'));
        $this->assertTrue($this->entity->equals($entity_2));
    }
    
}