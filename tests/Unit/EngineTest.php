<?php

namespace CarClean\Tests\Unit;

use CarClean\Runner\Engine;
use CarClean\Entity\Car;
use CarClean\Entity\Algorithm;
use CarClean\Algorithm\GGCleaningAlgorithm;
use CarClean\Algorithm\FCCleaningAlgorithm;

class EngineTest extends TestCase
{
    CONST CLEAN_METHOD = [
        1 => 1,
        2 => 2,
    ];

    protected function setUp()
    {
        parent::setUp();

        $alg1 = new Algorithm;
        $alg1->id = 1;
        $alg1->algClass = GGCleaningAlgorithm::class;
        app('em')->store($alg1);

        $alg2 = new Algorithm;
        $alg2->id = 2;
        $alg2->algClass = FCCleaningAlgorithm::class;
        app('em')->store($alg2);

        $car1 = new Car;
        $car1->fill([
            'id' => 1,
            'pod_id' => 1,
            'class_id' => 1,
            'last_clean' => 5,
        ]);
        app('em')->store($car1);

        $car2 = new Car;
        $car2->fill([
            'id' => 2,
            'pod_id' => 2,
            'class_id' => 2,
            'last_clean' => 8,
        ]);
        app('em')->store($car2);
    }

    public function engineDataProvider()
    {
        return [
            [1, GGCleaningAlgorithm::class],
            [2, FCCleaningAlgorithm::class],
        ];
    }

    /**
     * @dataProvider engineDataProvider
     */
    public function test_create_cleaning_strategy($carId, $expected)
    {
        $engine = new Engine;
        $alg = $engine->createCleaningStrategy($carId, self::CLEAN_METHOD);
        $this->assertInstanceOf($expected, $alg);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function test_create_cleaning_strategy_with_invalid_arguments()
    {
        $engine = new Engine;
        $engine->createCleaningStrategy(3, self::CLEAN_METHOD);
    }
}