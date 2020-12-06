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

    /**
     * Will check if route is in the route array
     * @param $request
     * @return object
     * @throws Exception
     */
    private function inGetRoutes($request): object
    {
        if (!key_exists($request->route, $this->getRoutes())) {
            throw new Exception(PageNotFoundEnum::PAGE_NOT_FOUND);
        }

        $route = self::$routes['get'][$request->route];

        return $this->mapControllerToAction($route);
    }

    /**
     *
     * @param $request
     * @return object
     * @throws Exception
     */
    private function inPostRoutes($request): object
    {
        if (!key_exists($request->route, $this->postRoutes())) {
            throw new Exception(PageNotFoundEnum::PAGE_NOT_FOUND);
        }

        $route = self::$routes['post'][$request->route];

        return $this->mapControllerToAction($route);

    }

    /**
     * will return a standard object with controller and action
     * @param array $route
     * @return object
     */
    private function mapControllerToAction(array $route): object
    {

        $route = $this->explodeRoute($route);

        return (object) [
            'controller' => $route[0] ?? null,
            'action' => $route[1] ?? null,
        ];
    }

    /**
     * will split the route to a method and action
     * @param string $route
     * @return array
     */
    private function explodeRoute(string $route): array
    {
        return explode('@', $route);
    }

    /**
     * An array that ruturns the full route array
     * @return array
     */
    public static function getAllRoutes(): array
    {
        return static::$routes;
    }

}