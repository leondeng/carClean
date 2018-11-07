<?php

namespace CarClean\Interfaces;

interface IEntity
{
    public function fill(array $data) : IEntity;

    public function getId() : int;
}
