<?php
// add(string "regex", array "methods", string "controller", string "action", string "name")
$router->add("/(article)?", ['GET'], 'App\Controller\ArticleController', 'index', 'articles');
$router->add("/article/new", ['GET', 'POST'], 'App\Controller\ArticleController', 'new', 'add_article');
$router->add("/article/(\d+)/show", ['GET'], 'App\Controller\ArticleController', 'show', 'show_article');
$router->add("/article/(\d+)/edit", ['GET', 'POST'], 'App\Controller\ArticleController', 'edit', 'edit_article');
$router->add("/article/(\d+)/delete", ['GET'], 'App\Controller\ArticleController', 'delete', 'delete_article');