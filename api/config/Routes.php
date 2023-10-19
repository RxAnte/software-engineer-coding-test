<?php

declare(strict_types=1);

namespace Config;

use Slim\Routing\RouteCollectorProxy;
use SoftwareEngineering\ToDos\Add\PostAddToDoAction;
use SoftwareEngineering\ToDos\GetToDoListAction;

class Routes
{
    public static function create(RouteCollectorProxy $routes): void
    {
        GetToDoListAction::setRoute($routes);
        PostAddToDoAction::setRoute($routes);
    }
}
