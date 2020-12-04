<?php

namespace ShoppingCart\Router;

use Exception;
use ShoppingCart\Enums\PageNotFoundEnum;
use ShoppingCart\Enums\ServerRequestMethodEnum;
use ShoppingCart\Request\Request;

class Router
{

    private static array $routes = [
        'post' => [],
        'get' => [],
    ];


    public static function addGet(string $route, string $controllerAction)
    {
        static::$routes['get'][$route] = $controllerAction;
    }

    public static function addPost(string $route, string $controllerAction)
    {
        static::$routes['post'][$route] = $controllerAction;
    }

    public function getRoutes()
    {
        return self::$routes['get'];
    }

    public function postRoutes()
    {
        return self::$routes['post'];
    }


    /** Will return the route
     * @param Request $request
     * @return object
     * @throws Exception
     */
    public function routeExist(Request $request): object
    {
        switch ($request->request['request_method']) {
            case ServerRequestMethodEnum::REQUEST_METHOD_GET:
                return $this->inGetRoutes($request->request['request_mapping']);
            case ServerRequestMethodEnum::REQUEST_METHOD_POST:
                return $this->inPostRoutes($request->request['request_mapping']);
            default:
                throw new Exception('Route Does Not Exist');
        }
    }

    private function inGetRoutes($request)
    {
        if (!key_exists($request->route, $this->getRoutes())) {
            throw new Exception(PageNotFoundEnum::PAGE_NOT_FOUND);
        }

        $route = self::$routes['get'][$request->route];

        return $this->mapControllerToAction($route);
    }

    private function inPostRoutes($request)
    {
        if (!key_exists($request->route, $this->postRoutes())) {
            throw new Exception(PageNotFoundEnum::PAGE_NOT_FOUND);
        }

        $route = self::$routes['post'][$request->route];

        return $this->mapControllerToAction($route);

    }

    private function mapControllerToAction($route): object
    {

        $route = $this->explodeRoute($route);

        return (object) [
            'controller' => $route[0] ?? null,
            'action' => $route[1] ?? null,
        ];
    }

    private function explodeRoute($route): array
    {
        return explode('@', $route);
    }

    public static function getAllRoutes()
    {
        return static::$routes;
    }

}