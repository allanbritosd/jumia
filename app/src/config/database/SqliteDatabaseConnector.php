<?php
namespace App\Config\Database;

use App\Contracts\IPdoDatabaseConnector;

class SqliteDatabaseConnector implements IPdoDatabaseConnector
{
    private $pdo;

    public function __construct(string $databasePath)
    {
        try
        {
            $this->pdo = new \PDO('sqlite:' . $databasePath);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception)
        {
            throw $exception;
        }
    }

    public function executeQuery(string $sql, array $parameters = []): \PDOStatement
    {
        $statement = $this->pdo->prepare($sql);
        $data = [];
        foreach ($parameters as $parameter) {
            $data[] = $parameter;
        }
        $result = $statement->execute($data);

        return $statement;
    }

    public function getLastInsertId(string $table): int {
        return $this->pdo->query('SELECT max(id) from '.$table)->fetchColumn();
    }
}
