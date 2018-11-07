<?php

namespace CarClean\Entity;

use CarClean\Interfaces\IAlgorithm;

class Algorithm extends BaseEntity
{
    public $algClass;

    public function getAlgorithm() : IAlgorithm
    {
        return new $this->algClass($this);
    }
}
