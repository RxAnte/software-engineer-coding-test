<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\Persistence;

use SoftwareEngineering\ActionResult;
use SoftwareEngineering\Persistence\AppPdo;

use function implode;

// phpcs:disable Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps

readonly class SaveToDo
{
    public function __construct(private AppPdo $pdo)
    {
    }

    public function save(ToDoRecord $record): ActionResult
    {
        if ($record->title === '') {
            return new ActionResult(
                false,
                ['Title is required'],
            );
        }

        $statement = $this->pdo->prepare(implode(' ', [
            'UPDATE',
            $record->tableName(),
            'SET',
            'title = :title, is_done = :is_done',
            'WHERE id = :id',
        ]));

        $result = $statement->execute([
            ':title' => $record->title,
            ':is_done' => $record->is_done,
            ':id' => $record->id,
        ]);

        if (! $result) {
            return new ActionResult(
                false,
                $this->pdo->errorInfo(),
                $this->pdo->errorCode(),
            );
        }

        return new ActionResult();
    }
}
