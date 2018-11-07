<?php

namespace CarClean\Algorithm;

use CarClean\Interfaces\IAlgorithm;
use CarClean\Interfaces\IEntity;
use CarClean\Entity\Algorithm;

abstract class BaseCleaningAlgorithm implements IAlgorithm
{
    private $entity;

    public function __construct(Algorithm $entity = null)
    {
        $this->entity = $entity;
    }

    public function getEntity() : IEntity
    {
        return $this->entity;
    }
}
