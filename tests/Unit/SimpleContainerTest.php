<?php

namespace CarClean\Tests\Unit;

use CarClean\Container\SimpleContainer;
use CarClean\EntityManager\ArrayEntityManager;
use CarClean\Algorithm\FCCleaningAlgorithm;
use CarClean\Entity\Algorithm;

class SimpleContainerTest extends TestCase
{
    protected function setUp()
    {
    }

    public function test_get_instance()
    {
        $container = SimpleContainer::getInstance();
        $this->assertInstanceOf(SimpleContainer::class, $container);
        $this->assertSame($container, SimpleContainer::getInstance());

        return $container;
    }

    /**
     * @depends test_get_instance
     */
    public function test_register($container)
    {
        $container->register('em', ArrayEntityManager::class);
        $this->assertEquals(ArrayEntityManager::class, $container->getClassNameByAlias('em'));

        return $container;
    }

    /**
     * @depends test_register
     * @expectedException InvalidArgumentException
     */
    public function test_get_class_name_by__invalidalias($container)
    {
        $container->getClassNameByAlias('invalid');
    }

    /**
     * @depends test_register
     */
    public function test_make($container)
    {
        $em = $container->make('em');
        $this->assertInstanceOf(ArrayEntityManager::class, $em);
    }

    /**
     * @depends test_get_instance
     */
    public function test_make_with_arguments($container)
    {
        $container->register('fcc', FCCleaningAlgorithm::class);
        $algEntity = new Algorithm;
        $algEntity->id = 1;
        $algEntity->algClass = FCCleaningAlgorithm::class;

        $fcc = $container->make('fcc', [
            'entity' => $algEntity,
        ]);

        $this->assertInstanceOf(FCCleaningAlgorithm::class, $fcc);
        $this->assertInstanceOf(Algorithm::class, $fcc->getEntity());
    }
}
