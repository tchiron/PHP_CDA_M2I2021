<?php

namespace App\Controller;

use App\Dao\ArticleDao;
use App\Model\Article;
use PDOException;

/**
 * Controller du model Article
 */
class ArticleController
{
    /**
     * Affichage de tous les articles
     */
    public function index(): void
    {
        // Récupérer tous les articles
        try {
            $articles = (new ArticleDao())->getAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            // require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "error500.html.php"]);
        }

        // Démarage de la mise en tampon
        ob_start();
        $title = 'Accueil';
        // Appel de la vue
        require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "article", "index.html.php"]);
        // Récupération et enregistrement des données dans une variable et suppression de la mémoire tampon
        $content = ob_get_clean(); // Equivaut à ob_get_content() suivi de ob_end_clean()

        // Appel du layout
        require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "layout.html.php"]);
    }

    /**
     * Création d'un nouvel article
     */
    public function new(): void
    {
        $request_method = filter_input(INPUT_SERVER, "REQUEST_METHOD");

        if ('GET' === $request_method) {
            // Démarage de la mise en tampon
            ob_start();
            $title = 'Nouvel article';
            // Appel de la vue
            require implode(DIRECTORY_SEPARATOR, [TEMPLATES, 'article', 'new.html.php']);
            // Récupération et enregistrement des données dans une variable et suppression de la mémoire tampon
            $content = ob_get_clean();

            // Appel du layout
            require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "layout.html.php"]);
        } elseif ('POST' === $request_method) {
            // Récupération des données envoyées depuis le formulaire
            $args = [
                "title" => [],
                "content" => []
            ];
            $article_post = filter_input_array(INPUT_POST, $args);

            // Vérification qu'on n'a pas reçu de champs vide ou rempli d'espace
            if (isset($article_post["title"]) && isset($article_post["content"])) {
                if (empty(trim($article_post["title"]))) {
                    $error_messages[] = "Titre inexistant";
                }

                if (empty(trim($article_post["content"]))) {
                    $error_messages[] = "Contenu inexistant";
                }
            }

            // Instanciation d'un article avec les valeurs récupérées dans le formulaire
            $article = (new Article())->setTitle($article_post["title"])->setContent($article_post["content"]);

            if (empty($error_messages)) {
                try {
                    // Création du nouvel article et récupération de son identifiant
                    $id = (new ArticleDao())->new($article);
                    // Redirection sur l'affiche de l'article nouvellement créée
                    header(sprintf("Location: /article/%d/show", $id));
                    exit;
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            } else {
                // Démarage de la mise en tampon
                ob_start();
                $title = 'Nouvel article';
                // Appel de la vue
                require implode(DIRECTORY_SEPARATOR, [TEMPLATES, 'article', 'new.html.php']);
                // Récupération et enregistrement des données dans une variable et suppression de la mémoire tampon
                $content = ob_get_clean();

                // Appel du layout
                require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "layout.html.php"]);
            }
        }
    }

    /**
     * Affichage d'un article en fonction de son identifiant unique
     *
     * @param int $id Identifiant de l'article
     */
    public function show(int $id): void
    {
        try {
            // Récupération de l'article en fonction de son identifiant
            $article = (new ArticleDao())->getById($id);

            if ($article instanceof Article) {
                // Démarage de la mise en tampon
                ob_start();
                $title = $article->getTitle();
                // Appel de la vue
                require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "article", "show.html.php"]);
                // Récupération et enregistrement des données dans une variable et suppression de la mémoire tampon
                $content = ob_get_clean();

                // Appel du layout
                require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "layout.html.php"]);
            } else {
                header("Location: /");
                exit;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Edition d'un article en fonction de son identifiant unique
     *
     * @param int $id Identifiant de l'article
     */
    public function edit(int $id): void
    {

        $request_method = filter_input(INPUT_SERVER, "REQUEST_METHOD");

        // Récupérer un article en fonction de son id
        try {
            // Intanciation d'un ArticleDao
            $articleDao = new ArticleDao();
            // Récupération de l'article en fonction de son identifiant
            $article = $articleDao->getById($id);

            if ($article instanceof Article) {
                header("Location: /"); // ou error 404
                exit;
            } elseif ('GET' === $request_method) {
                // Démarage de la mise en tampon
                ob_start();
                $title = "Editer {$article->getTitle()}";
                // Appel de la vue
                require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "article", "edit.html.php"]);
                // Récupération et enregistrement des données dans une variable et suppression de la mémoire tampon
                $content = ob_get_clean();

                // Appel du layout
                require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "layout.html.php"]);
            } elseif ('POST' === $request_method) {
                // Récupération des données envoyées depuis le formulaire
                $args = [
                    "title" => [],
                    "content" => []
                ];
                $article_post = filter_input_array(INPUT_POST, $args);

                // Vérification qu'on n'a pas reçu de champs vide ou rempli d'espace
                if (isset($article_post["title"]) && isset($article_post["content"])) {
                    if (empty(trim($article_post["title"]))) {
                        $error_messages[] = "Titre inexistant";
                    }

                    if (empty(trim($article_post["content"]))) {
                        $error_messages[] = "Contenu inexistant";
                    }
                }

                // Instanciation d'un article avec les valeurs récupérées dans le formulaire
                $article->setTitle($article_post["title"])->setContent($article_post["content"]);

                if (empty($error_messages)) {
                    // Edition de l'article
                    $articleDao->edit($article);
                    // Redirection vers l'article éditée
                    header(sprintf("Location: /article/%d/show", $id));
                    exit;
                } else {
                    // Démarage de la mise en tampon
                    ob_start();
                    $title = "Editer {$article->getTitle()}";
                    // Appel de la vue
                    require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "article", "edit.html.php"]);
                    // Récupération et enregistrement des données dans une variable et suppression de la mémoire tampon
                    $content = ob_get_clean();

                    // Appel du layout
                    require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "layout.html.php"]);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Suppression d'un article en fonction de son identifiant unique
     *
     * @param int $id Identifiant de l'article
     */
    public function delete(int $id): void
    {
        try {
            //Suppression de l'article en fonction de son identifiant
            (new ArticleDao())->delete($id);
            header("Location: /");
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
