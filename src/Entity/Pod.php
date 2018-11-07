<?php

namespace CarClean\Entity;

use CarClean\Interfaces\IPod;

class Pod extends BaseEntity implements IPod
{
    public $dirty;

    public function getDirty() : bool
    {
        return $this->dirty;
    }
}
