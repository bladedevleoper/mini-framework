<?php

namespace ShoppingCart\Factory;

use ShoppingCart\Request\Request;

class RequestFactory
{
    public static function makeRequest()
    {
        return new Request();
    }
}