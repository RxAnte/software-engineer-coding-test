<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos;

use SoftwareEngineering\ToDos\ValueObjects\Id;
use SoftwareEngineering\ToDos\ValueObjects\IsDone;
use SoftwareEngineering\ToDos\ValueObjects\Title;
use Spatie\Cloneable\Cloneable;

readonly class ToDo
{
    use Cloneable;

    public function __construct(
        public Id $id,
        public Title $title,
        public IsDone $isDone,
    ) {
    }

    /** @return scalar[] */
    public function asArray(): array
    {
        return [
            'id' => $this->id->toNative(),
            'title' => $this->title->toNative(),
            'isDone' => $this->isDone->toNative(),
        ];
    }
}
