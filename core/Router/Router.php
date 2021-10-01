<?php

namespace core\Router;

use core\Router\Exception\RouteNotFoundException;
use core\Router\Route\Route;

/**
 * Rediriges sur une action en fonction de la requête
 */
class Router
{
    /**
     * @var Router $instance Contient une instance d'elle-même
     */
    private static Router $instance;

    /**
     * @var Route[] $routes Contient un tableau de route
     */
    private array $routes = [];

    /**
     * @var array $matches Contient un tableau de valeur récupéré lors du preg_match
     */
    private array $matches = [];

    /**
     * Vérifies si une route correspond à la requête de l'utilisateur
     * Si oui, la méthode retourne la route correspondante
     * Sinon, elle lève une exception
     *
     * @return Route
     * @throws RouteNotFoundException
     */
    public function match(): Route
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
            "Route not found for uri \"%s\" and method \"%s\"",
            filter_input(INPUT_SERVER, 'REQUEST_URI'),
            filter_input(INPUT_SERVER, "REQUEST_METHOD")
        ));
    }

    /**
     * Ajoutes une nouvelle route
     *
     * @param string $regex regex de la query string
     * @param string[] $methods tableau contenant les méthodes d'accès la route
     * @param string $controller nom complet du controller (controller + namespace) où s'éxecutera l'action
     * @param string $action nom de l'action qui devra s'éxecuter
     * @param string $name nom de la route
     */
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

    /**
     * Un singleton permettant de ne créer qu'une instance de router
     * Et de la récupérer autant de fois qu'on le souhaites
     *
     * @return Router
     */
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

    /**
     * @param string $name
     * @return Route
     */
    public function findRoute(string $name): Route
    {
        foreach ($this->routes as $route){
            if ($route->getName() === $name) {
                return $route;
            }
        }

        throw new RouteNotFoundException(sprintf("Route not found for name \"%s\"", $name));
    }
}
