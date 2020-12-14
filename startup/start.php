<?php

use App\Dispatcher\Dispatcher;
use App\Http\Request\Request;
use App\Router\Router;

$dispatcher = new Dispatcher(new Request(), new Router());

//will handle the request and dispatch where required
$response = $dispatcher->handle();