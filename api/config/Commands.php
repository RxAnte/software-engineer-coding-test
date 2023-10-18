<?php

declare(strict_types=1);

namespace Config;

use Silly\Application;
use SoftwareEngineering\Persistence\CreateSchemaCommand;

class Commands
{
    public static function create(Application $app): void
    {
        CreateSchemaCommand::setCommand($app);
    }
}
