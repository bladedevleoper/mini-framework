<?php

namespace ShoppingCart\Mappers\Requests;

use Exception;

class RequestMapper
{
    private static string $url;
    //private static array $params = [];

    private static function setProperties(array $request): void
    {
        if (count($request) >= 1) {
            if (strpos($request[0], '?')) {
                //TODO look at refactoring this and putting this in its own method of the request class
                $request = splitString($request[0], '?');
                static::$url = $request[0];
            } else {
                static::$url = array_shift($request);
            }
        } else {
            static::$url = array_shift($request) ?? '';
        }
    }

    public static function mapRequest(array $request): object
    {
        static::setProperties($request);

        return (object)[
            'route' => '/' . self::$url,
        ];

    }
}