<?php

namespace core\Router\Route;

/**
 * Représente une route
 */
class Route
{
    /**
     * @param $regex string contient la regex de la query string
     * @param $methods string[] contient un tableau des méthodes d'accès la route
     * @param $controller string contient le nom complet du controller (controller + namespace) où s'éxecutera l'action
     * @param $action string contient le nom de l'action qui devra s'éxecuter
     * @param $name string contient le nom de la route
     */
    public function __construct(
        private string $regex,
        private array $methods,
        private string $controller,
        private string $action,
        private string $name
    ) {
    }

    /**
     * Get the value of regex
     *
     * @return string
     */
    public function getRegex(): string
    {
        return $this->regex;
    }

    /**
     * Get the value of methods
     *
     * @return string[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }
    
    /**
     * Get the value of controller
     *
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * Get the value of action
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }
    
    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
