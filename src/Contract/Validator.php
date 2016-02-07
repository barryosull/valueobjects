<?php

namespace EventSourced\Contract;

interface Validator 
{
    /**
     * Check if the arguments pass validation
     * 
     * @param type $arguments
     */
    public function is_valid($arguments);
        
    /** 
     * This error message is not intended for display to users, 
     * it is merely used to give more context to Exceptions
     */
    public function error_message();
}
