<?php

declare(strict_types=1);

namespace Config;

use BuzzingPixel\Container\Container as ContainerImplementation;
use PDO;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use RuntimeException;
use Slim\Psr7\Factory\ResponseFactory;
use SoftwareEngineering\Persistence\AppPdo;
use SoftwareEngineering\Persistence\AppPdoFactory;

use function assert;
use function implode;

readonly class Container
{
    public static function create(): ContainerInterface
    {
        return new ContainerImplementation(
            [
                PDO::class => static function (): void {
                    throw new RuntimeException(
                        implode(' ', [
                            'Please request a specific instace of PDO such as',
                            AppPdo::class,
                        ]),
                    );
                },
                AppPdo::class => static function (ContainerInterface $di): AppPdo {
                    $factory = $di->get(AppPdoFactory::class);
                    assert($factory instanceof AppPdoFactory);

                    return $factory->create();
                },
                ResponseFactoryInterface::class => ResponseFactory::class,
            ],
        );
    }
}
