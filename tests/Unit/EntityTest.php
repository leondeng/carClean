<?php

namespace CarClean\Tests\Unit;

use CarClean\Entity\Car;
use CarClean\Entity\CarClass;
use CarClean\Entity\Pod;

class EntityTest extends TestCase
{
    public function test_fill()
    {
        $pod = new Pod();
        $pod->fill([
            'id' => 5,
            'dirty' => false,
        ]);

        $this->assertEquals(5, $pod->id);
        $this->assertFalse($pod->dirty);
    }
}