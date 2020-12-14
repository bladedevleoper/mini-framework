<?php

namespace App\Classes\FindController;

use Exception;
use App\Enums\ControllerNameSpaceEnum;

class FindController
{

    /**
     * Will provide the full namespace to the controller
     * @param string $className
     * @return string
     */
    private function getFullClassName(string $className): string
    {
        return ControllerNameSpaceEnum::CONTROLLER_NAMESPACE . $className;
    }

    /**
     * Will check
     * @param string $controller
     * @return bool
     */
    public function controllerExists(string $controller): bool
    {
        return class_exists($this->getFullClassName($controller));
    }

    /**
     * Will check if the method exists within the controller
     * @param object|null $controller
     * @param string|null $method
     * @return bool
     * @throws Exception
     */
    public function methodExist(object|null $controller, string|null $method): bool
    {
        if (!method_exists($controller, $method)) {
            throw new Exception(message: $method . ' method does not exist in ' . get_class($controller));
        }

        return method_exists($controller, $method);
    }

    /**
     * Will instantiate the controller that is found
     * @param string $class
     * @return object
     */
    public function getController(string $class): object
    {
        $controller = $this->getFullClassName(className: $class);

        return new $controller();
    }


}