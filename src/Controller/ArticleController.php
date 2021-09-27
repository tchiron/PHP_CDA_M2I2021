<?php

namespace App\Controller;

use App\Dao\ArticleDao;

class ArticleController
{
    public function index(): void
    {
        echo "<h1>Liste des articles</h1>";
        // Récupérer tous les articles
        $articles = (new ArticleDao())->getAll();

        // Appeler (inclure) la vue
        require TEMPLATES . DIRECTORY_SEPARATOR . "article" . DIRECTORY_SEPARATOR . "index.html.php";


        // ob_start();
        // require "index.html.php";
        // $content = ob_get_clean();

        // // Appeler le layout
        // require "layout.html.php";
    }

    public function show(): void
    {
        // Récupérer un article en fonction de son id

        // Appeler (inclure) la vue
        ob_start();
        require "show.html.php";
        $content = ob_get_clean();

        // Appeler le layout
        require "layout.html.php";
    }
}
