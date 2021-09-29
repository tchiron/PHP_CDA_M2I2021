<?php

namespace App\Dao;

use core\Database;
use PDO;

abstract class AbstractDao
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnexion();
    }
}
