<?php

namespace CarClean\Algorithm;

use CarClean\Entity\Car;

class FCCleaningAlgorithm extends BaseCleaningAlgorithm
{
    CONST MAX_CLEAN_INTERVAL = 7;

    public function calculateNextClean(array $car, array $pods, array $classes, array $settings): int
    {
        $carEntity = new Car;
        $carEntity->fill($car);

        if ($carEntity->last_clean >= self::MAX_CLEAN_INTERVAL) {
            return 0;
        }

        return self::MAX_CLEAN_INTERVAL - $carEntity->last_clean;
    }
}
