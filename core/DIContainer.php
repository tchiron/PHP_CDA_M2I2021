<?php

namespace core;

use App\Controller\AbstractController;
use App\Dao\AbstractDao;

class DIContainer
{
    public function getController(string $controller): AbstractController
    {
        return ControllerFactory::create($controller);
    }

    public function getDao(string $daoName): AbstractDao
    {
        return DaoFactory::create($daoName);
    }
}