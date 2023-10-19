<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\Persistence;

use SoftwareEngineering\Persistence\ActionResult;
use SoftwareEngineering\Persistence\AppPdo;

use function implode;

// phpcs:disable Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps

readonly class CreateToDo
{
    public function __construct(private AppPdo $pdo)
    {
    }

    public function create(ToDoRecord $record): ActionResult
    {
        if ($record->title === '') {
            return new ActionResult(
                false,
                ['Title is required'],
            );
        }

        $statement = $this->pdo->prepare(implode(' ', [
            'INSERT INTO',
            $record->tableName(),
            '(id, title, is_done)',
            'VALUES',
            '(:id, :title, :is_done)',
        ]));

        $result = $statement->execute([
            'id' => $record->id,
            'title' => $record->title,
            'is_done' => $record->is_done,
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
