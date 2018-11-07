<?php

namespace CarClean\Tests\Unit;

use PHPUnit\Framework\TestCase as BaseTestCase;
use CarClean\EntityManager\ArrayEntityManager;

class TestCase extends BaseTestCase
{
    protected function setUp()
    {
        app()->register('em', ArrayEntityManager::class);
        app('em')->reset();
    }

    protected function log(string $message) {
        echo $message;
    }
}