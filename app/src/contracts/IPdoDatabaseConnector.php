<?php
namespace App\Contracts;

interface IPdoDatabaseConnector
{
    public static function getConnection(): \PDO;
    public static function executeQuery(string $sql): \PDOStatement;
}
