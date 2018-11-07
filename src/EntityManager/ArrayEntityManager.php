<?php

namespace CarClean\EntityManager;

use CarClean\Interfaces\IEntity;
use CarClean\Interfaces\IEntityManager;
use CarClean\Factory\EntityFactory;
use CarClean\Exception\EntityNotFoundException;

class ArrayEntityManager implements IEntityManager
{
    private $dataStore = [];

    public function store(IEntity $entity)
    {
        $entityClass = get_class($entity);
        $entityId = $entity->getId();

        if (array_key_exists($entityClass, $this->dataStore)) {
            $this->dataStore[$entityClass][$entityId] = get_object_vars($entity);
        } else {
            $this->dataStore[$entityClass] = [
                $entityId => get_object_vars($entity),
            ];
        }
    }

    public function find(string $entityClass, int $id) : IEntity
    {
        if (!class_exists($entityClass)) {
            throw new \InvalidArgumentException("Invalid entity class '{$entityClass}'!");
        }
        
        if (array_key_exists($entityClass, $this->dataStore) && array_key_exists($id, $this->dataStore[$entityClass])) {
            return EntityFactory::make($entityClass, $this->dataStore[$entityClass][$id]);
        }

        throw new EntityNotFoundException("{$entityClass} #{$id} not found.");        
    }

    public function getDataStore()
    {
        return $this->dataStore;
    }

    public function reset()
    {
        $this->dataStore = [];
    }
}