<?php

namespace App\Exceptions;

use Exception;

class ResourceNotFoundException extends Exception
{
    public function __construct($msg = "Resource")
    {
        $this->code = "error-201";
        $this->message = $msg . " not found";
        parent::__construct();
    }
}
