<?php

namespace CarClean\Tests\Unit;

use CarClean\Factory\EntityFactory;
use CarClean\Entity\Algorithm;
use CarClean\Algorithm\GGCleaningAlgorithm;

class EntityFactoryTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function test_make_with_invalid_class_name()
    {
        EntityFactory::make('invlalid_class', []);
    }

    public function test_make()
    {
        $alg = EntityFactory::make(Algorithm::class, [
            'id' => 1,
            'algClass' => GGCleaningAlgorithm::class,
        ]);

        $this->assertEquals(1, $alg->id);
        $this->assertEquals(GGCleaningAlgorithm::class, $alg->algClass);
    }
}