<?php

namespace App\Library\Redirect;

use App\Enums\ServerRequestMethodEnum;
use App\Http\Request\Request;

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