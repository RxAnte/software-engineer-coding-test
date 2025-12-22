<?php

declare(strict_types=1);

use Cli\Aliases;
use Cli\CliSrcPath;
use RxAnte\AppBootstrap\Boot;
use RxAnte\AppBootstrap\BootConfig;

require __DIR__ . '/vendor/autoload.php';

new Aliases()->map();

new Boot()
    ->start(config: new BootConfig(isCli: true))
    ->buildContainer()
    ->registerEventSubscribers(register: CliSrcPath::EVENTS)
    ->buildCliApplication()
    ->applyCommands()
    ->runApplication();
