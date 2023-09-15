<?php

namespace App\Exceptions;

use Exception;

class ResourceAlreadyExistsException extends Exception
{
    public function __construct()
    {
        $this->code = "error-200";
        $this->message = "Resource already exists";
        parent::__construct();
    }
}
