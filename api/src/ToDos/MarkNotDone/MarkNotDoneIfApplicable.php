<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\MarkNotDone;

use SoftwareEngineering\ActionResult;
use SoftwareEngineering\ToDos\ToDoRepository;
use SoftwareEngineering\ToDos\ValueObjects\IsDone;

readonly class MarkNotDoneIfApplicable
{
    public function __construct(private ToDoRepository $repository)
    {
    }

    public function mark(string $id): ActionResult
    {
        $todo = $this->repository->findAll()
            ->filterById($id)
            ->firstOrNull();

        if ($todo === null) {
            return new ActionResult(
                false,
                ['Invalid ToDo'],
            );
        }

        return $this->repository->save($todo->with(
            isDone: IsDone::fromNative(false),
        ));
    }
}
