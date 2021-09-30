<?php

namespace App\Dao;

use App\Model\Article;
use PDO;

class ArticleDao extends AbstractDao implements ArticleDaoInterface
{
    /**
     * Récupération de tous les articles
     *
     * @return Article[]
     */
    public function getAll(): array
    {
        $req = $this->pdo->prepare("SELECT * FROM article");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);

        // Parser les données récupérer
        // et en faire un tableau d'Article
        foreach ($result as $key => $article) {
            $result[$key] = (new Article())->setId($article['id'])
                ->setTitle($article['title'])
                ->setContent($article['content'])
                ->setCreatedAt($article['created_at']);
        }

        return $result;
    }

    /**
     * Insertion d'un nouvel article
     *
     * @param Article $article Article à insérer
     * @return int Identifiant de l'article nouvellement créée
     */
    public function new(Article $article): int
    {
        $req = $this->pdo->prepare(
            "INSERT INTO article (title, content)
            VALUES (:title, :content)"
        );
        $req->execute([
            ":title" => $article->getTitle(),
            ":content" => $article->getContent()
        ]);

        return $this->pdo->lastInsertId();
    }

    /**
     * Récupération d'un article en fonction de son identifiant
     *
     * @param int $id Identifiant de l'article à récupérer
     * @return Article|null Renvoi l'article si il en trouve un, sinon renvoi null
     */
    public function getById(int $id): ?Article
    {
        $req = $this->pdo->prepare("SELECT * FROM article WHERE id = :id");
        $req->execute([
            ":id" => $id
        ]);
        $result = $req->fetch(PDO::FETCH_ASSOC);

        // Parser les données récupérer
        // et instancier un nouvel Article
        // qu'on retourne avec les données récupérées
        if (!empty($result)) {
            return (new Article())->setId($result['id'])
                ->setTitle($result['title'])
                ->setContent($result['content'])
                ->setCreatedAt($result['created_at']);
        } else {
            return null;
        }
    }

    /**
     * Edition d'un article
     *
     * @param Article $article Article à éditer
     */
    public function edit(Article $article): void
    {
        $req = $this->pdo->prepare("UPDATE article
                            SET title = :title, content = :content
                            WHERE id = :id");
        $req->execute([
            ":id" => $article->getId(),
            ":title" => $article->getTitle(),
            ":content" => $article->getContent()
        ]);
    }

    /**
     * Suppression d'un article
     *
     * @param int $id Identifiant de l'article à supprimer
     */
    public function delete(int $id): void
    {
        $req = $this->pdo->prepare("DELETE FROM article WHERE id = :id");
        $req->execute([
            ":id" => $id
        ]);
    }
}
