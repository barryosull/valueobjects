<?php  namespace EventSourced\ValueObject\Deserializer;

class Exception extends \Exception
{
    private $error_messages;

    public function __construct($error_messages)
    {
        $this->error_messages = $error_messages;
        $message = "Error deserializing object";
        parent::__construct($message, 0, null);
    }

    public function error_messages()
    {
        return $this->error_messages;
    }

}