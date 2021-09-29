<?php

namespace core;

use PDO;

class Database
{
    protected static Database $instance;

    protected string $dsn;
    protected string $user;
    protected string $password;
    protected PDO $pdo;

    public function __construct()
    {
    }
    
    public function setDatabase(string $database, string $filePath): Database
    {
        if ('mysql' === $database) {
            $conf = parse_ini_file($filePath, false, INI_SCANNER_TYPED);
            $this->dsn = sprintf(
                "mysql:host=%s;dbname=%s;charset=%s",
                $conf['host'],
                $conf['dbname'],
                $conf['charset']
            );
            $this->user = $conf['user'];
            $this->password = $conf['password'];
        }

        return $this;
    }

    public function init(array $options)
    {
        $this->pdo = new PDO(
            $this->dsn,
            $this->user,
            $this->password,
            $options
        );
    }

    public function getConnexion(): PDO
    {
        return $this->pdo;
    }

    public static function getInstance(): Database
    {
        if (empty(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
}
