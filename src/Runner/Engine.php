<?php

namespace CarClean\Runner;

use CarClean\Interfaces\IEntityManager;
use CarClean\Interfaces\IStrategyMaker;
use CarClean\Interfaces\IAlgorithm;
use CarClean\Entity\Car;
use CarClean\Entity\Algorithm;

class Engine implements IStrategyMaker
{
    public function createCleaningStrategy(int $car_id, array $cleaning_method): IAlgorithm
    {
        if (!array_key_exists($car_id, $cleaning_method)) {
            throw new \InvalidArgumentException("Invalid cleaning algorithm for car #{$car_id}!");
        }

        $algEntity = app('em')->find(Algorithm::class, $cleaning_method[$car_id]);
        return $algEntity->getAlgorithm();
    }
}