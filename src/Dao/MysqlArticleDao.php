<?php

namespace App\Dao;

use App\Model\Article;
use PDO;

class MysqlArticleDao extends AbstractDao implements ArticleDaoInterface
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
        return $req->fetchAll(PDO::FETCH_CLASS, Article::class);
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
     * @return Article|false Renvoi l'article si il en trouve un, sinon renvoi false
     */
    public function getById(int $id): Article|false
    {
        $req = $this->pdo->prepare("SELECT * FROM article WHERE id = :id");
        $req->execute([
            ":id" => $id
        ]);
        return $req->fetchObject(Article::class);
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
