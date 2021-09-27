<?php

use App\Controller\ArticleController;

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";

dump($_SERVER);

// Récupérer la uri/url
$uri = filter_input(INPUT_SERVER, "REQUEST_URI");

// Envoyer l'uri au router
if ("/" === $uri) { // "/article"
    (new ArticleController())->index();
}
// "/article/id/show" => ArticleController->show
// "/article/id/new" => ArticleController->new
// "/article/id/edit" => ArticleController->edit
// "/article/id/delete" => ArticleController->delete


// Appliquer l'action