<?php

namespace App\Controller;

use App\Dao\ArticleDao;
use App\Model\Article;
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

    public function new(): void
    {
        $request_method = filter_input(INPUT_SERVER, "REQUEST_METHOD");

        if ('GET' === $request_method) {
            require implode(DIRECTORY_SEPARATOR, [TEMPLATES, 'article', 'new.html.php']);

            // ob_start();
            // require "show.html.php";
            // $content = ob_get_clean();

            // // Appeler le layout
            // require "layout.html.php";
        } elseif ('POST' === $request_method) {
            $args = [
                "title" => [],
                "content" => []
            ];

            $article_post = filter_input_array(INPUT_POST, $args);

            if (isset($article_post["title"]) && isset($article_post["content"])) {
                if (empty(trim($article_post["title"]))) {
                    $error_messages[] = "Titre inexistant";
                }

                if (empty(trim($article_post["content"]))) {
                    $error_messages[] = "Contenu inexistant";
                }
            }

            $article = (new Article())->setTitle($article_post["title"])->setContent($article_post["content"]);

            if (empty($error_messages)) {
                try {
                    $id = (new ArticleDao())->new($article);
                    header(sprintf("Location: /article/%d/show", $id));
                    exit;
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            } else {
                require implode(DIRECTORY_SEPARATOR, [TEMPLATES, 'article', 'new.html.php']);
            }
        }
    }

    public function show(int $id): void
    {
        // Récupérer un article en fonction de son id
        try {
            $article = (new ArticleDao())->getById($id);

            if (!is_null($article)) {
                // Appeler (inclure) la vue
                require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "article", "show.html.php"]);

                // ob_start();
                // require "show.html.php";
                // $content = ob_get_clean();

                // // Appeler le layout
                // require "layout.html.php";
            } else {
                header("Location: /");
                exit;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function edit(int $id): void
    {

        $request_method = filter_input(INPUT_SERVER, "REQUEST_METHOD");

        // Récupérer un article en fonction de son id
        try {
            $articleDao = new ArticleDao();
            $article = $articleDao->getById($id);

            if (is_null($article)) {
                header("Location: /"); // ou error 404
                exit;
            } elseif ('GET' === $request_method) {
                // Appeler (inclure) la vue
                require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "article", "edit.html.php"]);

                // ob_start();
                // require "show.html.php";
                // $content = ob_get_clean();

                // // Appeler le layout
                // require "layout.html.php";
            } elseif ('POST' === $request_method) {
                $args = [
                    "title" => [],
                    "content" => []
                ];

                $article_post = filter_input_array(INPUT_POST, $args);

                if (isset($article_post["title"]) && isset($article_post["content"])) {
                    if (empty(trim($article_post["title"]))) {
                        $error_messages[] = "Titre inexistant";
                    }

                    if (empty(trim($article_post["content"]))) {
                        $error_messages[] = "Contenu inexistant";
                    }
                }

                $article->setTitle($article_post["title"])->setContent($article_post["content"]);

                if (empty($error_messages)) {
                    $articleDao->edit($article);
                    header(sprintf("Location: /article/%d/show", $id));
                    exit;
                } else {
                    require implode(DIRECTORY_SEPARATOR, [TEMPLATES, 'article', 'edit.html.php']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete(int $id): void
    {
        // Supprimer un article en fonction de son id
        try {
            (new ArticleDao())->delete($id);
            header("Location: /");
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
