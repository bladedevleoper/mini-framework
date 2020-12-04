<?php

namespace ShoppingCart\Classes;

use ShoppingCart\Request\Request;
use ShoppingCart\Enums\DirectoryEnum;
use ShoppingCart\Traits\SetCookie;

class CookieController
{
    use SetCookie;

    public function registerCookie($shoppingCart = [])
    {
        $request = new Request();
        dd($request);
        //$shoppingCart['order'] = ['milk', 'onions', 'bounty'];

//        if (empty($shoppingCart)) {
//            return header('Location:' . DirectoryEnum::HOME_DIRECTORY);
//        }
        /*use trait setCookie to set the cookie to return with the headers
            - https://www.php.net/manual/en/function.setcookie.php
        */
       //dd($_REQUEST);
        $data = json_decode($_POST['shopping_items'], true);

        if (isset($data)) {

            //dd($data);

            header('HTTP/1.1 200 OK');
            header('Content-Type: application/json');
            http_response_code(200);


            $jsonData = json_encode(['message' => 'Shopping Cart Saved']);

            echo $jsonData;

            exit;
        }

    }

}