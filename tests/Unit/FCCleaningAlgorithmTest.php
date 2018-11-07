<?php

namespace CarClean\Tests\Unit;

use CarClean\Entity\Car;
use CarClean\Entity\Algorithm;
use CarClean\Algorithm\FCCleaningAlgorithm;

class FCCleaningAlgorithmTest extends TestCase
{
    private $alg;

    protected function setUp()
    {
        parent::setUp();

        $algEntity = new Algorithm;
        $algEntity->id = 2;
        $algEntity->algClass = FCCleaningAlgorithm::class;
        $this->alg = $algEntity->getAlgorithm();
    }

    public function test_get_entity()
    {
        $entity = $this->alg->getEntity();
        $this->assertInstanceOf(Algorithm::class, $entity);
    }

    public function algDataProvider()
    {
        return [
            [ 0, 7 ],
            [ 1, 6 ],
            [ 2, 5 ],
            [ 3, 4 ],
            [ 4, 3 ],
            [ 5, 2 ],
            [ 6, 1 ],
            [ 7, 0 ],
            [ 8, 0 ],
            [ 31, 0 ],
            [ 365, 0 ],
        ];
    }

    /**
     * @dataProvider algDataProvider
     */
    public function test_algorithm($last_clean, $expected)
    {
        $car = new Car;
        $car->last_clean = $last_clean;

        $this->assertEquals($expected, $this->alg->calculateNextClean(get_object_vars($car), [], [], []));
    }
}