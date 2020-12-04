<?php

namespace ShoppingCart\Library\Redirect;

use ShoppingCart\Enums\ServerRequestMethodEnum;
use ShoppingCart\Request\Request;

class Redirect
{

    private Request $request;

    public function __construct()
    {
        $this->request = new Request();

    }

    public function back()
    {
        if (Request::$requestMethod == ServerRequestMethodEnum::REQUEST_METHOD_POST) {
            return header("location:" . $this->request->getUrl());
        }

    }
}