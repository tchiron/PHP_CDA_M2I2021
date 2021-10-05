<?php
/**
 * Ici se trouvera toutes les routes vers les controllers
 *
 * L'ajout de route demande plusieurs arguments, en voici sa signature :
 * add(string $regex, array $methods, string $controller, string $action, string $name)
 *
 * @var \core\Router\Router $router
 */
$router->add("/", ['GET'], 'Article', 'index', 'home');
$router->add("/article", ['GET'], 'Article', 'index', 'articles');
$router->add("/article/new", ['GET', 'POST'], 'Article', 'new', 'add_article');
$router->add("/article/(\d+)/show", ['GET'], 'Article', 'show', 'show_article');
$router->add("/article/(\d+)/edit", ['GET', 'POST'], 'Article', 'edit', 'edit_article');
$router->add("/article/(\d+)/delete", ['GET'], 'Article', 'delete', 'delete_article');