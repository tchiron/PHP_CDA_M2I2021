<?php

use core\{ControllerFactory, Database, DIContainer, Renderer};
use core\Router\Exception\RouteNotFoundException;
use core\Router\Router;

/**
 * Require du fichier de config
 */
require_once implode(DIRECTORY_SEPARATOR, [__DIR__, "..", "config", "config.php"]);

/**
 * Instanciation d'un singleton Database contenant une instance de PDO
 * Qui pourra par la suite être utilisé pour les méthodes d'accès à la base de données des DAO
 */
Database::getInstance()->setDatabase('mysql', MYSQL_FILE_PATH)->init([PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

/**
 * Instanciation d'un singleton Router qui contiendra les routes
 * Il pourra dans une évolution futur servir à rediriger sur une route depuis un controller
 */
$router = Router::getInstance();

/**
 * Require du fichier de routes
 */
require implode(DIRECTORY_SEPARATOR, [ROOT, 'config', 'routes.php']);

try {
    $route = $router->match();
    /**
     * Instancies le controller et l'action de la route qui correspond à la requête
     *
     * équivaut à : (new App\Controller\ArticleController())->index(new MysqlArticleDao())
     * équivaut à : (new App\Controller\ArticleController())->show(new MysqlArticleDao(), $id)
     */
    $dic = new DIContainer();
    $dic->getController($route->getController())
        ->{$route->getAction()}($dic->getDao($route->getController()), ...$router->getMatches());
} catch (RouteNotFoundException $e) {
    echo $e->getMessage();
    // header("Location: /"); // ou error 404
    // exit;
}