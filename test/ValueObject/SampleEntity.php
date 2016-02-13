<?php

use EventSourced\Assert;
use EventSourced\ValueObject\UUID;
use EventSourced\ValueObject\Date;
use EventSourced\ValueObject\SampleEntity;

class TestSampleEntity extends \PHPUnit_Framework_TestCase 
{
    private $entity;
    
    public function setUp()
    {
        $this->entity = new SampleEntity(new UUID("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8"), new Date('2012-01-20'));
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
    
}