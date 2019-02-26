<?php
namespace App\Config\Database;

use App\Contracts\IPdoDatabaseConnector;

class SqliteDatabaseConnector implements IPdoDatabaseConnector
{

    public static $instance;
    private $pdo;

    private function __construct()
    {
        try
        {
            $this->pdo = new \PDO('sqlite:' . getenv('SQLITE_DSN'));
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception)
        {
            throw $exception;
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function executeQuery(string $sql, array $parameters = []): \PDOStatement
    {
        $statement = self::getInstance()->pdo->prepare($sql);
        $data = [];
        foreach ($parameters as $parameter) {
            $data[] = $parameter;
        }
        $result = $statement->execute($data);

        return $statement;
    }

    public static function getLastInsertId(string $table): int {
        return self::getInstance()->pdo->query('SELECT max(id) from '.$table)->fetchColumn();
    }
}
