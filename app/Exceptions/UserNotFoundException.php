<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct()
    {
        $this->code = "error-202";
        $this->message = "User not found";
        parent::__construct();
    }
}
