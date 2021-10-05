<?php

namespace App\Dao;

use App\Model\Article;

class MongodbArticleDao extends AbstractDao implements ArticleDaoInterface
{

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @inheritDoc
     */
    public function new(Article $article): int
    {
        // TODO: Implement new() method.
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): Article|false
    {
        // TODO: Implement getById() method.
    }

    /**
     * @inheritDoc
     */
    public function edit(Article $article): void
    {
        // TODO: Implement edit() method.
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        // TODO: Implement delete() method.
    }
}