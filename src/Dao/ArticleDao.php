<?php

namespace App\Dao;

use App\Model\Article;
use PDO;

class ArticleDao implements ArticleDaoInterface
{
    public function getAll(): array
    {
        // Connexion la BDD
        $pdo = new PDO(
            "mysql:host=localhost;dbname=m2i_blog;charset=UTF8",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );

        // pour récupérer tous les articles
        $req = $pdo->prepare("SELECT * FROM article");
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
        // Connexion la BDD
        $pdo = new PDO(
            "mysql:host=localhost;dbname=m2i_blog;charset=UTF8",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );

        // Insertion de l'Article
        $req = $pdo->prepare(
            "INSERT INTO article (title, content)
            VALUES (:title, :content)"
        );
        $req->execute([
            ":title" => $article->getTitle(),
            ":content" => $article->getContent()
        ]);

        return $pdo->lastInsertId();
    }

    public function getById(int $id): ?Article
    {
        // Connexion la BDD
        $pdo = new PDO(
            "mysql:host=localhost;dbname=m2i_blog;charset=UTF8",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );

        // pour récupérer l'article
        $req = $pdo->prepare("SELECT * FROM article WHERE id = :id");
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
    }

    public function delete(int $id): void
    {
        // Connexion la BDD
        $pdo = new PDO(
            "mysql:host=localhost;dbname=m2i_blog;charset=UTF8",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );

        // Suppression de l'Article
        $req = $pdo->prepare(
            "DELETE FROM article WHERE id = :id"
        );
        $req->execute([
            ":id" => $id
        ]);
    }
}
