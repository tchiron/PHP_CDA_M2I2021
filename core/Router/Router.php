<?php

namespace core\Router;

use core\Router\Exception\RouteNotFoundException;
use core\Router\Route\Route;

class Router
{
    private static Router $instance;

    private array $routes = [];

    private array $matches = [];

    public function match(): ?Route
    {
        foreach ($this->routes as $route) {
            $regex = $route->getRegex();

            if (preg_match("#^$regex$#", filter_input(INPUT_SERVER, 'REQUEST_URI'), $this->matches)) {
                array_shift($this->matches);

                foreach ($route->getMethods() as  $method) {
                    if ($method === filter_input(INPUT_SERVER, "REQUEST_METHOD")) {
                        return $route;
                    }
                }
            }
        }

        throw new RouteNotFoundException(sprintf(
            "Route not found for uri %s and method %s",
            filter_input(INPUT_SERVER, 'REQUEST_URI'),
            filter_input(INPUT_SERVER, "REQUEST_METHOD")
        ));
    }

    public function add(
        string $regex,
        array $methods,
        string $controller,
        string $action,
        string $name
    ): void {
        $this->routes[] = new Route(
            $regex,
            $methods,
            $controller,
            $action,
            $name
        );
    }

    // Avec l'uri
    // on récupère l'action du controller qui est lié

    // Appliquer l'action

    public static function getInstance(): Router
    {
        return self::$instance ?? self::$instance = new Router();
    }

    /**
     * Get the value of matches
     *
     * @return array
     */
    public function getMatches(): array
    {
        return $this->matches;
    }
}
