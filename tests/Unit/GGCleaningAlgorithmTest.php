<?php

namespace CarClean\Tests\Unit;

use CarClean\Entity\Car;
use CarClean\Algorithm\GGCleaningAlgorithm;

class GGCleaningAlgorithmTest extends TestCase
{
    CONST PODS_FIXTURE = [
        [ 11 => true, 12 => false ],
    ];

    CONST CLASSES_FIXTURE = [
        [ 1 => 0.7, 2 => 1.0, 3 => 1.5 ],
    ];

    CONST SETTINGS_FIXTURE = [
        [
            'dirty_pod' => 0.9,
            'min_freq' => 7,
            'std_freq' => 14,
            'max_freq' => 28,
        ],
        [
            'dirty_pod' => 0.6,
            'min_freq' => 5,
            'std_freq' => 10,
            'max_freq' => 15,
        ],
        [
            'dirty_pod' => 0.9,
            'min_freq' => 6,
            'std_freq' => 12,
            'max_freq' => 13,
        ],
        [
            'dirty_pod' => 0.1,
            'min_freq' => 8,
            'std_freq' => 9,
            'max_freq' => 10,
        ],
    ];

    CONST CARS_FIXTURE = [
        7 => [
            'id' => 7,
            'pod_id' => 11,
            'class_id' => 3,
            'last_clean' => 5,
        ],
        8 => [
            'id' => 8,
            'pod_id' => 12,
            'class_id' => 1,
            'last_clean' => 7,
        ],
        9 => [
            'id' => 9,
            'pod_id' => 13,
            'class_id' => 3,
            'last_clean' => 7,
        ],
        10 => [
            'id' => 10,
            'pod_id' => 14,
            'class_id' => 2,
            'last_clean' => 3,
        ],
        11 => [
            'id' => 11,
            'pod_id' => 11,
            'class_id' => 3,
            'last_clean' => 25,
        ],
    ];

    private $alg;

    protected function setUp()
    {
        parent::setUp();

        $this->alg = new GGCleaningAlgorithm;
    }

    public function algDataProvider()
    {
        return [
            [ 7, 0, 0, 0, 14 ],
            [ 8, 0, 0, 0, 3 ],
            [ 9, 0, 0, 0, 14 ],
            [ 10, 0, 0, 0, 11 ],
            [ 11, 0, 0, 0, 0 ],
            [ 7, 0, 0, 1, 4 ],
            [ 8, 0, 0, 1, 0 ],
            [ 9, 0, 0, 1, 8 ],
            [ 10, 0, 0, 1, 7 ],
            [ 11, 0, 0, 1, 0 ],
            [ 7, 0, 0, 2, 8 ],
            [ 7, 0, 0, 3, 3 ],
        ];
    }

    /**
     * @dataProvider algDataProvider
     */
    public function test_algorithm($carId, $podsIndex, $classesIndex, $settingsIndex, $expected)
    {
        $this->assertEquals(
            $expected,
            $this->alg->calculateNextClean(
                self::CARS_FIXTURE[$carId],
                self::PODS_FIXTURE[$podsIndex],
                self::CLASSES_FIXTURE[$classesIndex],
                self::SETTINGS_FIXTURE[$settingsIndex]
        ));
    }
}