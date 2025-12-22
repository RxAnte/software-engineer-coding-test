<?php

declare(strict_types=1);

namespace Cli;

use Composer\ClassMapGenerator\ClassMapGenerator;

class CommandClasses
{
    private static array $classStrings;

    public static function classStrings(): array
    {
        if (!isset(static::$classStrings)) {
            $generator = new ClassMapGenerator();
            $generator->scanPaths(__DIR__ . '/Commands');

            static::$classStrings = array_keys(
                $generator->getClassMap()->map
            );
        }

        return static::$classStrings;
    }
}
