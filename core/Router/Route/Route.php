<?php

namespace core\Router\Route;

class Route
{
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
     * @return array
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
