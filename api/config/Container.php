<?php

declare(strict_types=1);

namespace Config;

use BuzzingPixel\Container\Container as ContainerImplementation;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Psr7\Factory\ResponseFactory;

class Container
{
    public static function create(): ContainerInterface
    {
        return new ContainerImplementation(
            [
                ResponseFactoryInterface::class => ResponseFactory::class,
            ],
        );
    }
}
