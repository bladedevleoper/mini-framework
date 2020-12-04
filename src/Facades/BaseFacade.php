<?php


namespace ShoppingCart\Facades;

use ShoppingCart\Facades\Classes;

class BaseFacade
{

    public $facade;

    public function __construct()
    {
        $this->facade = __CLASS__;

    }

    /**
     * will return the current facade
     * @param $name
     */
    public static function resolveFacade($name)
    {
        return new $name();
    }


    public static function __callStatic($method, $arguments)
    {
        var_dump('being called');
        return (self::resolveFacade(self::getFacadeAccessor()))->$method(...$arguments);
    }

    protected static function getFacadeAccessor()
    {
        return 'Route';
    }

}