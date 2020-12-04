<?php

namespace ShoppingCart\Factory;

use ShoppingCart\Classes\Jeans;
use ShoppingCart\Classes\Jumper;
use ShoppingCart\Classes\TShirt;

class ClothesFactory
{
    public static function make(string $type, array $payload)
    {
        switch ($type) {
            case 'jeans':
                return new Jeans($payload, $type);

            case 'jumper':
                return new Jumper($payload, $type);

            case 't_shirt':
                return new TShirt($payload, $type);
        }
    }
}