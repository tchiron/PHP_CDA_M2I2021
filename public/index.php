<?php

use App\Controller\ArticleController;

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, "..", "config", "config.php"]);

// Récupérer la uri/url
$uri = filter_input(INPUT_SERVER, "REQUEST_URI");

// Envoyer l'uri au router
if (preg_match("#^/(article)?$#", $uri)) {
    (new ArticleController())->index();
} elseif (preg_match("#^/article/new$#", $uri)) {
    (new ArticleController())->new();
} elseif (preg_match("#^/article/(\d+)/show$#", $uri, $matches)) {
    (new ArticleController())->show($matches[1]);
} elseif (preg_match("#^/article/(\d+)/delete$#", $uri, $matches)) {
    (new ArticleController())->delete($matches[1]);
}
// "/article/new" => ArticleController->new
// "/article/id/show" => ArticleController->show
// "/article/id/edit" => ArticleController->edit
// "/article/id/delete" => ArticleController->delete


// Appliquer l'action