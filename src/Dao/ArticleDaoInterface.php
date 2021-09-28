<?php

namespace App\Dao;

use App\Model\Article;

interface ArticleDaoInterface {
    public function getAll(): array;
    public function getById(int $id): ?Article;
    public function new(Article $article): int;
    public function edit(Article $article): void;
    public function delete(int $id): void;
}
