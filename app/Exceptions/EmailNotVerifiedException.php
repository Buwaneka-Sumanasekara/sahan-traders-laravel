<?php

namespace App\Exceptions;

use Exception;

class EmailNotVerifiedException extends Exception
{
    public function __construct()
    {
        $this->code = "error-101";
        $this->message = "Email not verified";
        parent::__construct();
    }
}
