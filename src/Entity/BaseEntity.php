<?php

namespace CarClean\Entity;

use CarClean\Interfaces\IEntity;
use CarClean\Interfaces\IEntityManager;

abstract class BaseEntity implements IEntity
{
    public $id;

    public function fill(array $data) : IEntity
    {
        foreach (get_object_vars($this) as $name => $value) {
            $this->$name = isset($data[$name]) ? $data[$name] : NULL;
        }

        return $this;
    }

    public function getId() : int
    {
        return $this->id;
    }
}
