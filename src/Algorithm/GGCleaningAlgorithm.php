<?php

namespace CarClean\Algorithm;

use CarClean\Entity\Car;
use CarClean\Entity\CarClass;
use CarClean\Entity\Pod;

class GGCleaningAlgorithm extends BaseCleaningAlgorithm
{
    public function calculateNextClean(array $car, array $pods, array $classes, array $settings): int
    {
        $this->loadEntities($pods, $classes);

        $carEntity = new Car;
        $carEntity->fill($car);

        $ret = $settings['std_freq'] * $carEntity->getFrequencyFactor();

        if ($carEntity->isEasilyDirty()) {
            $ret = $ret * $settings['dirty_pod'];
        }

        $ret = round($ret);

        if ($ret > $settings['max_freq']) {
            $ret = $settings['max_freq'];
        }

        if ($ret < $settings['min_freq']) {
            $ret = $settings['min_freq'];
        }

        $ret = $ret - $carEntity->last_clean;

        return $ret >= 0 ? $ret : 0;
    }

    private function loadEntities(array $pods, array $classes)
    {
        foreach ($pods as $id => $dirty) {
            $pod = new Pod;
            $pod->id = $id;
            $pod->dirty = $dirty;

            app('em')->store($pod);
        }

        foreach ($classes as $id => $factor) {
            $carClass = new CarClass;
            $carClass->id = $id;
            $carClass->factor = $factor;

            app('em')->store($carClass);
        }
    }
}
