<?php

namespace App\Factory;

use App\Http\Request\Request;

class RequestFactory
{
    public static function makeRequest()
    {
        return new Request();
    }
}