<?php

namespace src\models;

use src\models\entities\TableEntity;
use Exception;

class EntityFactory
{
    public function createEntity(string $entityName) : TableEntity
    {
        $entityName = 'src\\models\\entities\\' . $entityName;

        if (!class_exists($entityName))
            throw new Exception('Class `' . $entityName  .'` is not found!`');

        return new $entityName;
    }
}