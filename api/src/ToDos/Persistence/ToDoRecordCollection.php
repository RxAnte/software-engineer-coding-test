<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\Persistence;

use function array_map;
use function array_values;

readonly class ToDoRecordCollection
{
    /** @var ToDoRecord[] */
    public array $records;

    /** @param ToDoRecord[] $records */
    public function __construct(array $records = [])
    {
        $this->records = array_values(array_map(
            static fn (ToDoRecord $r) => $r,
            $records,
        ));
    }

    /** @return mixed[] */
    public function map(callable $callback): array
    {
        return array_values(array_map(
            $callback,
            $this->records,
        ));
    }
}
