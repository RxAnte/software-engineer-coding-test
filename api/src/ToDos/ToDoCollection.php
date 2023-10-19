<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos;

use function array_filter;
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

    public function filter(callable $callback): static
    {
        return new static(array_filter(
            $this->entities,
            $callback,
        ));
    }

    public function filterById(string $id): self
    {
        return $this->filter(
            static fn (ToDo $e) => $e->id->toNative() === $id
        );
    }

    public function first(): ToDo
    {
        return $this->entities[0];
    }

    public function firstOrNull(): ToDo|null
    {
        return $this->entities[0] ?? null;
    }

    /** @return array<array-key, scalar[]> */
    public function asArray(): array
    {
        return $this->map(static fn (ToDo $todo) => $todo->asArray());
    }
}
