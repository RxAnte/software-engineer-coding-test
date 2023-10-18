<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\Persistence;

use SoftwareEngineering\Persistence\AppPdo;

use function implode;

readonly class CreateToDoTable
{
    public function __construct(private AppPdo $pdo)
    {
    }

    public function create(): void
    {
        $sql = implode(' ', [
            'CREATE TABLE IF NOT EXISTS',
            '" ' . ToDoRecord::getTableName() . ' "',
            '(',
            '"id" varchar NOT NULL DEFAULT "",',
            '"title" varchar NOT NULL DEFAULT "",',
            '"is_done" integer NOT NULL DEFAULT "0"',
            ')',
        ]);

        $this->pdo->exec($sql);
    }
}
