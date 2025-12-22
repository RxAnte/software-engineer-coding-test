<?php

declare(strict_types=1);

namespace Cli\Events;

use Cli\CommandClasses;
use RxAnte\AppBootstrap\Cli\ApplyCliCommandsEvent;
use Throwable;

readonly class ApplyCliCommandsEventSubscriber
{
    public function onDispatch(ApplyCliCommandsEvent $commands): void
    {
        array_map(
            static function (string $classString) use ($commands) {
                try {
                    $method = $classString . '::applyCommand';

                    if (! is_callable($method)) {
                        return ;
                    }

                    call_user_func_array($method, [$commands]);
                } catch (Throwable) {
                }
            },
            CommandClasses::classStrings(),
        );
    }
}
