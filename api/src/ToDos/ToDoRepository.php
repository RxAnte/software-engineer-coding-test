<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos;

use SoftwareEngineering\ToDos\Persistence\FindToDos;
use SoftwareEngineering\ToDos\Persistence\ToDoRecord;
use SoftwareEngineering\ToDos\ValueObjects\Id;
use SoftwareEngineering\ToDos\ValueObjects\IsDone;
use SoftwareEngineering\ToDos\ValueObjects\Title;

// phpcs:disable Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps

readonly class ToDoRepository
{
    public function __construct(private FindToDos $find)
    {
    }

    public function findAll(): ToDoCollection
    {
        $records = $this->find->findAll();

        return new ToDoCollection($records->map(
            static fn (ToDoRecord $record) => new ToDo(
                Id::fromNative($record->id),
                Title::fromNative($record->title),
                IsDone::fromNative($record->is_done),
            ),
        ));
    }
}
