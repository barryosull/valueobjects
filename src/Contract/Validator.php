<?php

namespace EventSourced\Contract;

interface Validator 
{
    public function is_valid($arguments);
    
    public function error_message();
}
