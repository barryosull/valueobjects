<?php namespace EventSourced\ValueObject\Assert;

class Exception extends \Exception
{
    private $error_messages;
    private $valueobject_class;
    
    public function __construct($valueobject_class, $error_messages)
    {
        $this->valueobject_class = $valueobject_class;
        $this->error_messages = $error_messages;
        $message = "Invalid value for '$valueobject_class'";
        parent::__construct($message, 0, null);
    }
    
    public function error_messages()
    {
        return $this->error_messages;
    }
    
    public function valueobject_class()
    {
        return $this->valueobject_class;
    }
}