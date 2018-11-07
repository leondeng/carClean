<?php

namespace CarClean\Interfaces;

interface IEntityManager
{
    public function store(IEntity $entity);

    public function find(string $entityClass, int $id) : IEntity;

    public function reset();
}
