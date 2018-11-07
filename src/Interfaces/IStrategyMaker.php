<?php

namespace CarClean\Interfaces;

interface IStrategyMaker
{
    public function createCleaningStrategy(int $car_id, array $cleaning_method): IAlgorithm;
}
