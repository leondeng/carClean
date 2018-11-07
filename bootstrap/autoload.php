<?php

require __DIR__.'/../vendor/autoload.php';

use CarClean\EntityManager\ArrayEntityManager;

app()->register('em', ArrayEntityManager::class);
