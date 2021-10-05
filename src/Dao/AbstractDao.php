<?php

namespace App\Dao;

use PDO;

abstract class AbstractDao
{
    /**
     * @var PDO Contient le pdo généré dans core\Database
     */
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}
