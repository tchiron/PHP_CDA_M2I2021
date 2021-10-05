<?php

namespace core;

use App\Controller\AbstractController;
use core\Router\Router;

class ControllerFactory
{
    public static function create(string $controller): AbstractController
    {
        $controllerPath = sprintf("App\Controller\%sController", ucfirst(strtolower($controller)));
        return new $controllerPath(Router::getInstance(), Renderer::getInstance());
    }
}