<?php

namespace core;

use App\Dao\AbstractDao;

class DaoFactory
{
    public static function create(string $daoName): AbstractDao
    {
        $daoPath = sprintf("App\Dao\%s%sDao", ucfirst(strtolower(RDBMS)), ucfirst(strtolower($daoName)));
        return new $daoPath(Database::getInstance()->getConnexion());
    }
}