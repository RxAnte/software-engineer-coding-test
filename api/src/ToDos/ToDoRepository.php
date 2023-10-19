<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos;

use SoftwareEngineering\Persistence\ActionResult;
use SoftwareEngineering\Persistence\UuidFactoryWithOrderedTimeCodec;
use SoftwareEngineering\ToDos\Persistence\CreateToDo;
use SoftwareEngineering\ToDos\Persistence\FindToDos;
use SoftwareEngineering\ToDos\Persistence\ToDoRecord;
use SoftwareEngineering\ToDos\ValueObjects\Id;
use SoftwareEngineering\ToDos\ValueObjects\IsDone;
use SoftwareEngineering\ToDos\ValueObjects\Title;

// phpcs:disable Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps

readonly class ToDoRepository
{
    public function __construct(
        private FindToDos $find,
        private CreateToDo $create,
        private UuidFactoryWithOrderedTimeCodec $uuidFactory,
    ) {
    }

    public function create(string $title): ActionResult
    {
        $record = new ToDoRecord();

        $record->id = $this->uuidFactory->uuid4()->toString();

        $record->title = $title;

        return $this->create->create($record);
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
