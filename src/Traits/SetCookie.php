<?php

namespace ShoppingCart\Traits;


trait SetCookie
{
    public function setCookie($keyName, $value, $expires): bool
    {
        //TODO hash the entries 
        $value = json_encode($value);

       return setcookie($keyName, $value, $expires, '', '', true, false);
    }
}