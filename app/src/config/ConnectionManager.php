<?php
namespace App\Config;

use App\Contracts\IPdoDatabaseConnector;

class ConnectionManager implements IPdoDatabaseConnector
{

    public static $instance;
    private $databaseConnector;

    private function __construct() {
    }

    public static function init(IPdoDatabaseConnector $databaseConnector)
    {
        self::getInstance()->databaseConnector = $databaseConnector;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function executeQuery(string $sql, array $parameters = []): \PDOStatement
    {
        return $this->databaseConnector->executeQuery($sql, $parameters);
    }

    public function getLastInsertId(string $table): int {
        return $this->databaseConnector->getLastInsertId($table);
    }
}
