<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos;

use function array_map;
use function array_values;

class ToDoCollection
{
    /** @var ToDo[] */
    public array $entities;

    /** @param ToDo[] $entities */
    public function __construct(array $entities = [])
    {
        $this->entities = array_values(array_map(
            static fn (ToDo $e) => $e,
            $entities,
        ));
    }

    /** @return mixed[] */
    public function map(callable $callback): array
    {
        return array_values(array_map(
            $callback,
            $this->entities,
        ));
    }

    /** @return array<array-key, scalar[]> */
    public function asArray(): array
    {
        return $this->map(static fn (ToDo $todo) => $todo->asArray());
    }
}
