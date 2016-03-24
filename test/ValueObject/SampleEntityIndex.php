<?php

use EventSourced\ValueObject\UUID;
use EventSourced\ValueObject\Date;
use EventSourced\ValueObject\SampleEntity;
use EventSourced\ValueObject\SampleEntityIndex;

class TestSampleEntityIndex extends \PHPUnit_Framework_TestCase 
{
    private $index;
    private $entity;
    
    public function setUp()
    {
        $this->entity = new SampleEntity(new UUID("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8"), new Date('2012-01-20'));
        $this->index = new SampleEntityIndex([$this->entity]);
    }
    
    public function test_replace() 
    {
        $replace = new SampleEntity(new UUID("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8"), new Date('2012-01-21'));
        $this->index->replace($replace);
    }
    
    public function test_invalid_replace() 
    {
        $this->setExpectedException(\Exception::class);
        $new = new SampleEntity(new UUID("bc9e4e83-5495-4a58-90d9-eeeaf3989bc8"), new Date('2012-01-21'));
        $this->index->replace($new);
    }
    
    public function test_add() 
    {
        $add = new SampleEntity(new UUID("bc9e4e83-5495-4a58-90d9-eeeaf3989bc8"), new Date('2012-01-21'));
        return $this->index->add($add);
    }
    
    public function test_invalid_add()            
    {
        $this->setExpectedException(\Exception::class);
        $existing = new SampleEntity(new UUID("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8"), new Date('2012-01-21'));
        $this->index->add($existing);
    }
    
    public function test_get_by_key()
    {
        $entity = $this->index->get(new UUID("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8"));
        $this->assertTrue($entity->equals($this->entity));
    }
    
    public function test_fail_to_get_by_key()
    {
        $this->setExpectedException(\Exception::class);
        $this->index->get(new UUID("ac9e4e83-5495-4a58-90d9-eeeaf3989bc1"));
    }
}