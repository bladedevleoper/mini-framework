<?php

namespace App\Router;

use App\Exceptions\RouteException;
use App\Enums\PageNotFoundEnum;
use App\Enums\ServerCodeEnum;
use App\Enums\ServerRequestMethodEnum;
use App\Http\Request\Request;

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
            throw new RouteException(PageNotFoundEnum::PAGE_NOT_FOUND, ServerCodeEnum::NOT_FOUND);
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
            throw new RouteException(PageNotFoundEnum::PAGE_NOT_FOUND, ServerCodeEnum::NOT_FOUND);
        }

        $route = self::$routes['post'][$request->route];

        return $this->mapControllerToAction($route);

    }

    /**
     * will return a standard object with controller and action
     * @param string $route
     * @return object
     */
    private function mapControllerToAction(string $route): object
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
     * An array that returns the full route array
     * @return array
     */
    public static function getAllRoutes(): array
    {
        return static::$routes;
    }

}