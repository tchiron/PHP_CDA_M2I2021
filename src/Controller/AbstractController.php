<?php

namespace App\Controller;

use core\Renderer;
use core\Router\Exception\RouteNotFoundException;
use core\Router\Router;

abstract class AbstractController
{
    public function __construct(
        protected Router   $router,
        protected Renderer $renderer
    )
    {
    }

    protected function redirectToRoute(string $name, array $options = [])
    {
        try {
            $route = $this->router->findRoute($name);
            $path = $route->getRegex();

            foreach ($options as $value) {
                $path = preg_replace("#\([a-zA-Z0-9\\\+]+\)#", $value, $path, 1);
            }

            header(sprintf("Location: %s", $path));
            exit;
        } catch (RouteNotFoundException $rnfe) {
            echo $rnfe->getMessage();
        }
    }
}