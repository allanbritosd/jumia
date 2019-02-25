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

    public static function getConnection(): \PDO
    {
        return self::getInstance()->pdo;
    }

    public static function executeQuery(string $sql): \PDOStatement
    {
        return self::getConnection()->query($sql);
    }
}
