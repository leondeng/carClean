<?php

namespace CarClean\Entity;

use CarClean\Interfaces\ICar;
use CarClean\Exception\EntityNotfoundException;

class Car extends BaseEntity implements ICar
{
    public $pod_id;

    public $class_id;

    public $last_clean;

    private function getPod()
    {
        return app('em')->find(Pod::class, $this->pod_id);
    }

    private function getCarClass()
    {
        return app('em')->find(CarClass::class, $this->class_id);
    }

    public function isEasilyDirty() : bool
    {
        try {
            return $this->getPod()->getDirty();
        } catch (EntityNotfoundException $e) {
            return false;
        }
    }

    public function getFrequencyFactor(): float
    {
        try {
            return $this->getCarClass()->getFactor();
        } catch (EntityNotfoundException $e) {
            return 1.0;
        }
    }
}
