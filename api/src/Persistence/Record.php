<?php

declare(strict_types=1);

namespace SoftwareEngineering\Persistence;

use RuntimeException;

use function implode;

abstract class Record
{
    abstract public static function getTableName(): string;

    abstract public function tableName(): string;

    /**
     * Ensure all columns are explicitly declared on the record. If we change
     * a column name, we'll get an exception when PDO tries to populate this
     */
    public function __set(string $name, mixed $value): void
    {
        throw new RuntimeException(
            implode(' ', [
                'Property',
                $name,
                'must be declared explicitly',
            ]),
        );
    }
}
