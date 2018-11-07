<?php

require_once(__DIR__ . '/../bootstrap/autoload.php');

use CarClean\Runner\Engine;
use CarClean\Entity\Car;
use CarClean\Entity\Algorithm;
use CarClean\Algorithm\FCCleaningAlgorithm;
use CarClean\Algorithm\GGCleaningAlgorithm;

$pods = [ 11 => true, 12 => false ];
$classes = [ 1 => 0.7, 2 => 1.0, 3 => 1.5 ];
$settings = [
    'dirty_pod' => 0.9,
    'min_freq' => 7,
    'std_freq' => 14,
    'max_freq' => 28,
];
$clean_method = [ 7 => 1, 8 => 1, 9 => 2, 10 => 2 ];

$car1 = [
    'id' => 7,
    'pod_id' => 11,
    'class_id' => 3,
    'last_clean' => 5,
];
$car2 = [
    'id' => 8,
    'pod_id' => 12,
    'class_id' => 1,
    'last_clean' => 7,
];
$car3 = [
    'id' => 9,
    'pod_id' => 13,
    'class_id' => 3,
    'last_clean' => 7,
];
$car4 = [
    'id' => 10,
    'pod_id' => 14,
    'class_id' => 2,
    'last_clean' => 3,
];

$cars = [ $car1, $car2, $car3, $car4 ];

$alg1 = new Algorithm;
$alg1->id = 1;
$alg1->algClass = GGCleaningAlgorithm::class;
app('em')->store($alg1);

$alg2 = new Algorithm;
$alg2->id = 2;
$alg2->algClass = FCCleaningAlgorithm::class;
app('em')->store($alg2);

$engine = new Engine;

echo "---------------- Car Clean Strategy Demo ----------------\r\n";
echo "|    Car ID \t|  Next Clean \t|  Algorithm Used \t|\r\n";
echo "---------------------------------------------------------\r\n";

foreach ($cars as $carData) {
    $car = new Car;
    $car->fill($carData);
    app('em')->store($car);

    $alg = $engine->createCleaningStrategy($car->id, $clean_method);

    $nextClean = $alg->calculateNextClean($carData, $pods, $classes, $settings);

    echo "|\t{$car->id} \t|\t{$nextClean} \t|\t{$alg->getEntity()->getId()} \t\t|\r\n";
}

echo "------------------------ End ----------------------------\r\n";

