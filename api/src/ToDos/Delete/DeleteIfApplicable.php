<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\Delete;

use SoftwareEngineering\ActionResult;
use SoftwareEngineering\ToDos\ToDoRepository;

readonly class DeleteIfApplicable
{
    public function __construct(private ToDoRepository $repository)
    {
    }

    public function delete(string $id): ActionResult
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

        return $this->repository->delete($todo->id->toNative());
    }
}
