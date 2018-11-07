<?php

namespace CarClean\Factory;

use CarClean\Interfaces\IEntityManager;
use CarClean\Interfaces\IEntity;

class EntityFactory
{
    public static function make(string $entityClass, array $data) : IEntity
    {
        if (!class_exists($entityClass)) {
            throw new \InvalidArgumentException("Invalid entity class '{$entityClass}'!");
        }

        $entity = new $entityClass();

        return $entity->fill($data);
    }
}