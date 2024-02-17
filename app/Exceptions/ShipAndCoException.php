<?php

namespace App\Exceptions;

use Exception;

class ShipAndCoException extends Exception
{
    private $_data = '';
    public function __construct($data)
    {
        $this->code = "error-300";//ship and co errors
        $this->message = "Ship and Co error";
        $this->_data=$data;

        parent::__construct();
    }

    public function getData()
    {
        return $this->_data;
    }
}
