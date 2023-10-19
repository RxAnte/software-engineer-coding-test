<?php

declare(strict_types=1);

namespace Config;

use Slim\Routing\RouteCollectorProxy;
use SoftwareEngineering\ToDos\Add\PostAddToDoAction;
use SoftwareEngineering\ToDos\Delete\DeleteToDoAction;
use SoftwareEngineering\ToDos\GetToDoListAction;
use SoftwareEngineering\ToDos\MarkDone\PatchMarkDoneAction;
use SoftwareEngineering\ToDos\MarkNotDone\PatchMarkNotDoneAction;

class Routes
{
    public static function create(RouteCollectorProxy $routes): void
    {
        GetToDoListAction::setRoute($routes);
        PostAddToDoAction::setRoute($routes);
        PatchMarkDoneAction::setRoute($routes);
        PatchMarkNotDoneAction::setRoute($routes);
        DeleteToDoAction::setRoute($routes);
    }
}
