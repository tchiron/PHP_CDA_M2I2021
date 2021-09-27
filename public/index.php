<?php

use App\Controller\ArticleController;

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, "..", "config", "config.php"]);

// Récupérer la uri/url
$uri = filter_input(INPUT_SERVER, "REQUEST_URI");

// Envoyer l'uri au router
if (preg_match("#^/$#", $uri)) { // "/article"
    (new ArticleController())->index();
}
// "/article/new" => ArticleController->new
// "/article/id/show" => ArticleController->show
// "/article/id/edit" => ArticleController->edit
// "/article/id/delete" => ArticleController->delete


// Appliquer l'action