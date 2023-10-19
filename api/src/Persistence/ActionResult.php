<?php

declare(strict_types=1);

namespace SoftwareEngineering\Persistence;

use function implode;

use const PHP_EOL;

class ActionResult
{
    /** @param string[] $message */
    public function __construct(
        public bool $success = true,
        public array $message = [],
        public int|string $errorCode = '',
    ) {
    }

    /** @return scalar[] */
    public function asArray(): array
    {
        return [
            'success' => $this->success,
            'message' => implode(PHP_EOL, $this->message),
        ];
    }
}
