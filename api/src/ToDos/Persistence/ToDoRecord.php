<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\Persistence;

use SoftwareEngineering\Persistence\Record;

// phpcs:disable Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps

class ToDoRecord extends Record
{
    private const TABLE_NAME = 'todos';

    public static function getTableName(): string
    {
        return self::TABLE_NAME;
    }

    public function tableName(): string
    {
        return self::TABLE_NAME;
    }

    public string $id = '';

    public string $title = '';

    public bool $is_done = false;
}
