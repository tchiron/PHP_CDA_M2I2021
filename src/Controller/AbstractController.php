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

    /**
     * Rediriges vers une route
     *
     * @param string $name Nom de la route
     * @param array $options Tableau de valeur a replacer dans la query string, Attention à bien respecter l'ordre
     */
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