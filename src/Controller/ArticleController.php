<?php

namespace App\Controller;

use App\Dao\ArticleDao;
use App\Model\Article;
use PDOException;

/**
 * Controller du model Article
 */
class ArticleController extends AbstractController
{
    /**
     * Affichage de tous les articles
     */
    public function index(): void
    {
        try {
            $articles = (new ArticleDao())->getAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            // require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "error500.html.php"]);
        }

        $this->renderer->render(
            ["layout.html.php"],
            ["article", "index.html.php"],
            ["title" => 'Accueil', "articles" => $articles]
        );
    }

    /**
     * Création d'un nouvel article
     */
    public function new(): void
    {
        $request_method = filter_input(INPUT_SERVER, "REQUEST_METHOD");

        if ('GET' === $request_method) {
            $this->renderer->render(
                ["layout.html.php"],
                ["article", "new.html.php"],
                ["title" => 'Nouvel article']
            );
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
                $this->renderer->render(
                    ["layout.html.php"],
                    ["article", "new.html.php"],
                    ["title" => 'Nouvel article', "error_messages" => $error_messages, "article" => $article]
                );
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
                $this->renderer->render(
                    ["layout.html.php"],
                    ["article", "show.html.php"],
                    ["title" => $article->getTitle(), 'article' => $article]
                );
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

            if (!$article instanceof Article) {
                header("Location: /"); // ou error 404
                exit;
            } elseif ('GET' === $request_method) {
                $this->renderer->render(
                    ["layout.html.php"],
                    ["article", "edit.html.php"],
                    ["title" => "Editer {$article->getTitle()}", "article" => $article]
                );
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
                    $this->renderer->render(
                        ["layout.html.php"],
                        ["article", "edit.html.php"],
                        [
                            "title" => "Editer {$article->getTitle()}",
                            "article" => $article,
                            "error_messages" => $error_messages
                        ]
                    );
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
