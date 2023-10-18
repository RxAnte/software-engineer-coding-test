<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\Persistence;

use PDO;
use SoftwareEngineering\Persistence\AppPdo;

use function implode;

readonly class FindToDos
{
    public function __construct(private AppPdo $pdo)
    {
    }

    public function findAll(): ToDoRecordCollection
    {
        $query = [
            'SELECT * FROM',
            ToDoRecord::getTableName(),
        ];

        $params = [];

        $statement = $this->pdo->prepare(
            implode(' ', $query),
        );

        $statement->execute($params);

        $results = $statement->fetchAll(
            PDO::FETCH_CLASS,
            ToDoRecord::class,
        );

        return new ToDoRecordCollection(
            $results !== false ? $results : [],
        );
    }
}
