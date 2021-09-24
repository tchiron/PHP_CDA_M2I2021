<?php

class ArticleController
{
    public function index(): void
    {
        // Récupérer tous les articles

        // Appeler (inclure) la vue
        ob_start();
        require "index.html.php";
        $content = ob_get_clean();

        // Appeler le layout
        require "layout.html.php";
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
