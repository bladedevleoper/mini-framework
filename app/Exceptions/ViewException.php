<?php

namespace App\Exceptions;

use Exception;

class ViewException extends Exception
{
    public $message;
    public $code;

    public function __construct(string $message, int $code)
    {
        $this->message = $message;
        $this->code = $code;
    }
}
