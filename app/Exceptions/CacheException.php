<?php

namespace App\Exceptions;

use Exception;

class CacheException extends Exception
{
    public string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }
}
