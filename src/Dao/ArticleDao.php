<?php

namespace App\Dao;

use App\Model\Article;
use PDO;

class ArticleDao
{
    public function getAll(): array
    {
        // Requeter la BDD
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
        foreach($result as $key => $article)
        {
            $result[$key] = (new Article())->setId($article['id'])
                ->setTitle($article['title'])
                ->setContent($article['content'])
                ->setCreatedAt($article['created_at']);
        }

        return $result;
    }
}
