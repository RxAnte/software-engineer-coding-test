<?php

declare(strict_types=1);

use Config\Container;
use Config\Routes;
use Slim\Factory\AppFactory;

require dirname(__DIR__) . '/vendor/autoload.php';

$app = AppFactory::create(container: Container::create());

Routes::create($app);

$app->run();
