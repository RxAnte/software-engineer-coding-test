<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\Add;

use SoftwareEngineering\ToDos\ValueObjects\Title;

readonly class PostData
{
    /** @param scalar[] $postData */
    public static function createFromArray(array $postData): self
    {
        return new self(Title::fromNative(
            (string) ($postData['title'] ?? ''),
        ));
    }

    public function __construct(public Title $title)
    {
    }
}
