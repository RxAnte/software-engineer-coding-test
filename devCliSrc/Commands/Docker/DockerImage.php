<?php

declare(strict_types=1);

namespace Cli\Commands\Docker;

use RuntimeException;
use Throwable;

use function array_map;
use function array_values;
use function constant;
use function implode;

enum DockerImage
{
    case api;
    case web;

    /**
     * @param array<array-key, string|DockerImage>|null $images
     *
     * @return self[]
     */
    public static function fromArray(array|null $images = null): array
    {
        if ($images === null) {
            return self::cases();
        }

        return array_values(array_map(
            static function (string|self $image): DockerImage {
                if ($image instanceof self) {
                    return $image;
                }

                try {
                    return constant(self::class . '::' . $image);
                } catch (Throwable) {
                    throw new RuntimeException(
                        $image . ' is not a valid image',
                    );
                }
            },
            $images,
        ));
    }

    public function tag(): string
    {
        return implode('', [
            'software-engineering-coding-test_',
            $this->name,
        ]);
    }

    public function dockerfilePath(): string
    {
        return implode('/', [
            'docker',
            $this->name,
            'Dockerfile',
        ]);
    }
}
