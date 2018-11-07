<?php

namespace CarClean\Tests\Unit;

use CarClean\Entity\Car;
use CarClean\Entity\CarClass;
use CarClean\Entity\Pod;

class EntityManagerTest extends TestCase
{

    public function test_store()
    {
        $pod = new Pod();
        $pod->id = 1;
        $pod->dirty = true;        
        app('em')->store($pod);

        $this->assertEquals([
            'CarClean\Entity\Pod' => [
                1 => [
                    'id' => 1,
                    'dirty' => true,
                ],
            ],
        ], app('em')->getDataStore());
    }

    public function test_find()
    {
        $pod = new Pod();
        $pod->id = 1;
        $pod->dirty = true;        
        app('em')->store($pod);

        $found = app('em')->find(Pod::class, 1);
        $this->assertInstanceOf(Pod::class, $found);
        $this->assertEquals(1, $found->id);
        $this->assertEquals(true, $found->dirty);
    }

    /**
     * @expectedException CarClean\Exception\EntityNotFoundException
     */
    public function test_not_found()
    {
        app('em')->find(CarClass::class, 1);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function test_invalid_entity_class()
    {
        app('em')->find('InvalidClassName', 1);
    }
}