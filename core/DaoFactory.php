<?php

namespace core;

use App\Dao\AbstractDao;

class DaoFactory
{
    /**
     * Créé une instance d'un DAO héritant d'AbstractDao
     *
     * @param string $daoName Nom du DAO à instancier, sans le suffixe "Dao"
     * @return AbstractDao Instance du DAO invoqué
     */
    public static function create(string $daoName): AbstractDao
    {
        $daoPath = sprintf("App\Dao\%s%sDao", ucfirst(strtolower(RDBMS)), ucfirst(strtolower($daoName)));
        return new $daoPath(Database::getInstance()->getConnexion());
    }
}