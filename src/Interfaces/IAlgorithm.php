<?php

namespace CarClean\Interfaces;

interface IAlgorithm
{
    public function calculateNextClean(array $car, array $pods, array $classes, array $settings): int;

    public function getEntity() : IEntity;
}
