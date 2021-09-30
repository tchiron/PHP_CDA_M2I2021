<?php

namespace core;

use PDO;

/**
 * Instancie et sauvegarde sa connexion à une base de données
 */
class Database
{
    /**
     * @var Database Contient une instance de Database
     */
    protected static Database $instance;

    /**
     * @var string Contient la database server name
     */
    protected string $dsn;

    /**
     * @var string Contient le nom d'utilisateur utilisé pour se connecter à la bdd
     */
    protected string $user;

    /**
     * @var string Contient le mot de passe de l'utilisateur utilisé pour se connecter à la bdd
     */
    protected string $password;

    /**
     * @var PDO Contient une instance de PDO
     */
    protected PDO $pdo;

    /**
     * Set the dsn, user and password
     *
     * @param string $database Nom de la SGBDR utilisé
     * @param string $filePath Chemin vers le fichier de configuration de la base de données
     * @return $this
     */
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

    /**
     * Initialise la connexion à la base de données
     *
     * @param array $options Options de PDO
     */
    public function init(array $options)
    {
        $this->pdo = new PDO(
            $this->dsn,
            $this->user,
            $this->password,
            $options
        );
    }

    /**
     * Récupères la valeur de pdo
     *
     * @return PDO
     */
    public function getConnexion(): PDO
    {
        return $this->pdo;
    }

    /**
     * Instancies une Database si elle n'existe pas déjà et la récupère
     *
     * @return Database
     */
    public static function getInstance(): Database
    {
        if (empty(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
}
