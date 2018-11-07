<?php

namespace CarClean\Interfaces;

interface ICar
{
    public function isEasilyDirty(): bool;

    public function getFrequencyFactor(): float;
}
