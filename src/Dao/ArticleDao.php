<?php

namespace App\Dao;

use App\Model\Article;
use PDO;

class ArticleDao extends AbstractDao implements ArticleDaoInterface
{
    public function getAll(): array
    {
        // Récupération tous les articles
        $req = self::getPdo()->prepare("SELECT * FROM article");
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

    public function new(Article $article): int
    {
        // Insertion de l'Article
        $req = self::getPdo()->prepare(
            "INSERT INTO article (title, content)
            VALUES (:title, :content)"
        );
        $req->execute([
            ":title" => $article->getTitle(),
            ":content" => $article->getContent()
        ]);

        return $this->getPdo()->lastInsertId();
    }

    public function getById(int $id): ?Article
    {
        // Récupération de l'article
        $req = self::getPdo()->prepare("SELECT * FROM article WHERE id = :id");
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

    public function edit(Article $article): void
    {
        // Mise à jour l'article
        $req = self::getPdo()->prepare("UPDATE article
                            SET title = :title, content = :content
                            WHERE id = :id");
        $req->execute([
            ":id" => $article->getId(),
            ":title" => $article->getTitle(),
            ":content" => $article->getContent()
        ]);
    }

    public function delete(int $id): void
    {
        // Suppression de l'Article
        $req = self::getPdo()->prepare("DELETE FROM article WHERE id = :id");
        $req->execute([
            ":id" => $id
        ]);
    }
}
