<?php

namespace core;

use App\Controller\AbstractController;
use App\Dao\AbstractDao;

class DIContainer
{
    /**
     * Invoque une instance de controller héritant d'AbstractController
     *
     * @param string $controllerName Nom de controller à invoquer, sans le suffixe "Controller"
     * @return AbstractController Instance du controller invoqué
     */
    public function getController(string $controllerName): AbstractController
    {
        return ControllerFactory::create($controllerName);
    }

    /**
     * Invoque une instance de controller héritant d'AbstractDao
     *
     * @param string $daoName Nom du DAO à invoquer, sans le suffixe "Dao"
     * @return AbstractDao Instance du DAO invoqué
     */
    public function getDao(string $daoName): AbstractDao
    {
        return DaoFactory::create($daoName);
    }
}