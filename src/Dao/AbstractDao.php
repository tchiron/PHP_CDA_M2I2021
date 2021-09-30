<?php

namespace App\Dao;

use core\Database;
use PDO;

abstract class AbstractDao
{
    /**
     * @var PDO Contient le pdo généré dans core\Database
     */
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnexion();
    }
}
