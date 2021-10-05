<?php

namespace core;

use App\Controller\AbstractController;
use core\Router\Router;

class ControllerFactory
{
    /**
     * Créé une instance d'un controller héritant d'AbstractController
     *
     * @param string $controllerName Nom du controller à instancier, sans le suffixe "Controller"
     * @return AbstractController Instance du controller invoqué
     */
    public static function create(string $controllerName): AbstractController
    {
        $controllerPath = sprintf("App\Controller\%sController", ucfirst(strtolower($controllerName)));
        return new $controllerPath(Router::getInstance(), Renderer::getInstance());
    }
}