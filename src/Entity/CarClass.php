<?php

namespace CarClean\Entity;

use CarClean\Interfaces\ICarClass;

class CarClass extends BaseEntity implements ICarClass
{
    public $factor;

    public function getFactor() : float
    {
        return $this->factor;
    }
}
