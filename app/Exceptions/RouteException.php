<?php

namespace App\Exceptions;

use Exception;

class RouteException extends Exception
{
    public function __construct($message, $code)
    {
        $this->message = $message;
        $this->code = $code;
    }
}