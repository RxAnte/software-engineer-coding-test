<?php

declare(strict_types=1);

namespace SoftwareEngineering\Persistence;

use Silly\Application;
use SoftwareEngineering\ToDos\Persistence\CreateToDoTable;

readonly class CreateSchemaCommand
{
    public static function setCommand(Application $app): void
    {
        $app->command('schema:up', self::class);
    }

    public function __construct(
        private CreateToDoTable $schema001CreateToDoTable,
    ) {
    }

    public function __invoke(): void
    {
        $this->schema001CreateToDoTable->create();
    }
}
