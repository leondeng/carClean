<?php

namespace CarClean\Tests\Unit;

use CarClean\Entity\Car;
use CarClean\Entity\CarClass;
use CarClean\Entity\Pod;

class CarTest extends TestCase
{
    public function podDataProvider()
    {
        return [
            [ 1, true, 1, true ],
            [ 2, false, 2, false ],
            [ 3, true, 5, false ],
            [ 4, false, 2, false ],
        ];
    }

    /**
     * @dataProvider podDataProvider
     */
    public function test_is_easily_dirty($podId, $dirty, $carPodId, $expected)
    {
        $pod = new Pod;
        $pod->id = $podId;
        $pod->dirty = $dirty;        
        app('em')->store($pod);

        $car = new Car;
        $car->pod_id = $carPodId;

        $this->assertEquals($expected, $car->isEasilyDirty());
    }

    public function carClassDataProvider()
    {
        return [
            [ 1, 0.9, 1, 0.9 ],
            [ 2, 1.1, 3, 1.0 ],
        ];
    }

    /**
     * @dataProvider carClassDataProvider
     */
    public function test_get_frequency_factor($carClassId, $factor, $carCarClassId, $expected)
    {
        $carClass = new CarClass;
        $carClass->id = $carClassId;
        $carClass->factor = $factor;        
        app('em')->store($carClass);

        $car = new Car;
        $car->class_id = $carCarClassId;

        $this->assertEquals($expected, $car->getFrequencyFactor());
    }
}