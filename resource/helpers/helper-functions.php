<?php

use App\Library\Redirect\Redirect;
use App\Http\Request\Request;
use App\TemplateEngine\View;

function dd($data)
{
    echo '<pre style="background:black; color:white; padding: 15px">';
        var_dump($data);
    echo '</pre>';

    exit;
}

function redirect()
{
    return new Redirect();
}

function splitString($string, $splitBy)
{
    return explode($splitBy, $string);
}


function request()
{
    return new Request();
}

function view($view, $params = [])
{
    return (new View($view, $params));
}