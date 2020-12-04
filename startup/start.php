<?php

use ShoppingCart\Dispatcher\Dispatcher;
use ShoppingCart\Request\Request;
use ShoppingCart\Router\Router;

$dispatcher = new Dispatcher(new Request(), new Router());

//will handle the request and dispatch where required
$response = $dispatcher->handle();