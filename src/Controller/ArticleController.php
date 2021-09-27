<?php

namespace App\Controller;

use App\Dao\ArticleDao;
use PDOException;

class ArticleController
{
    public function index(): void
    {
        // Récupérer tous les articles
        try {
            $articles = (new ArticleDao())->getAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            // require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "error500.html.php"]);
        }

        // Appeler (inclure) la vue
        require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "article", "index.html.php"]);

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
