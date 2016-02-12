<?php

use EventSourced\Assert;
use EventSourced\ValueObject\UUID;
use EventSourced\ValueObject\Date;
use EventSourced\ValueObject\SampleEntity;
use EventSourced\ValueObject\SampleEntityIndex;

class TestSampleEntityIndex extends \PHPUnit_Framework_TestCase 
{
    private $index;
    
    public function setUp()
    {
        $this->index = new SampleEntityIndex([
            new SampleEntity(new UUID("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8"), new Date('2012-01-20'))
        ]);
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
}