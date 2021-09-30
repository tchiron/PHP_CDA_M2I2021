<?php

namespace App\Dao;

use App\Model\Article;

interface ArticleDaoInterface {
    /**
     * Récupération de tous les articles
     *
     * @return Article[]
     */
    public function getAll(): array;

    /**
     * Insertion d'un nouvel article
     *
     * @param Article $article Article à insérer
     * @return int Identifiant de l'article nouvellement créée
     */
    public function new(Article $article): int;

    /**
     * Récupération d'un article en fonction de son identifiant
     *
     * @param int $id Identifiant de l'article à récupérer
     * @return Article|false Renvoi l'article si il en trouve un, sinon renvoi false
     */
    public function getById(int $id): Article|false;

    /**
     * Edition d'un article
     *
     * @param Article $article Article à éditer
     */
    public function edit(Article $article): void;

    /**
     * Suppression d'un article
     *
     * @param int $id Identifiant de l'article à supprimer
     */
    public function delete(int $id): void;
}
