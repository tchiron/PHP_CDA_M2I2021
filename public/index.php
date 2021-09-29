<?php

use core\Router\Exception\RouteNotFoundException;
use core\Router\Router;

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, "..", "config", "config.php"]);

$router = Router::getInstance();
// "regex", "methods", "controller", "action", "name"
$router->add("/(article)?", ['GET'], 'App\Controller\ArticleController', 'index', 'articles');
$router->add("/article/new", ['GET', 'POST'], 'App\Controller\ArticleController', 'new', 'add_article');
$router->add("/article/(\d+)/show", ['GET'], 'App\Controller\ArticleController', 'show', 'show_article');
$router->add("/article/(\d+)/edit", ['GET', 'POST'], 'App\Controller\ArticleController', 'edit', 'edit_article');
$router->add("/article/(\d+)/delete", ['GET'], 'App\Controller\ArticleController', 'delete', 'delete_article');

// Appliquer l'action
try {
    $route = $router->match();
    // (new App\Controller\ArticleController())->index()
    // (new App\Controller\ArticleController())->show($id)
    (new ($route->getController())())->{$route->getAction()}(...$router->getMatches());
} catch (RouteNotFoundException $e) {
    echo $e->getMessage();
    // header("Location: /"); // ou error 404
    // exit;
}