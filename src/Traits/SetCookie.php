<?php

namespace ShoppingCart\Traits;


trait SetCookie
{
    public function setCookie($keyName, $value, $expires): bool
    {
        //TODO hash the entries 

        $options = [
            'expires' => $expires,
            'path' => '/',
            'domain' => request()->getFullUrl()['host'],
            'secure' => true,
            'httponly' => true,
            'SameSite' => 'Strict',
        ];

       return setcookie($keyName, json_encode($value), $options);
    }
}