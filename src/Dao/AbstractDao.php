<?php

namespace App\Dao;

use PDO;

abstract class AbstractDao
{
    protected static PDO $pdo;

    public static function getPdo(): PDO
    {
        if (empty(self::$pdo)) {
            // Récupération du fichier de configuration mysql
            $conf = parse_ini_file(SGBDR_FILE_PATH, false, INI_SCANNER_TYPED);
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            // Connexion la BDD
            self::$pdo = new PDO(
                $conf['dsn'],
                $conf['user'],
                $conf['password'],
                $options
            );
        }
        return self::$pdo;
    }
}
