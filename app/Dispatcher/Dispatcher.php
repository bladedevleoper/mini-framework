<?php

namespace App\Dispatcher;

use Exception;
use App\Classes\FindController\FindController;
use App\Http\Request\Request;
use App\Router\Router;

class Dispatcher
{
    private Request $request;
    private Router $route;
    private FindController $findController;


    public function __construct(Request $request, Router $route)
    {
        $this->request = $request;
        $this->route = $route;
        $this->findController = new FindController();

    }

    public function handle()
    {
        try {

            $route = $this->route->routeExist($this->request->currentRequest());

            if (!empty($route)) {

                if ($this->findController->controllerExists($route->controller)){

                    $controller = $this->findController->getController($route->controller);

                    if (isset($route->action) && $this->findController->methodExist($controller, $route->action)) {

                        return $controller->{$route->action}();
                    }
                }

                //if no controller is found direct back to home
                //return dd('here');
            }

        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

}
