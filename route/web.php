<?php

use ShoppingCart\Router\Router;

//TODO add more routes here
//TODO look at the reflection class, get acquainted with that
Router::addGet('/', 'ShoppingListController@index');
Router::addGet('/home', 'SomeController@someMethod');
Router::addGet('/cookies', 'CookieController@setCookie');
Router::addPost('/register-cookie', 'CookieController@registerCookie');




