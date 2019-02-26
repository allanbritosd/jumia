<?php
namespace App\Contracts;

interface IPdoDatabaseConnector
{
    public static function executeQuery(string $sql): \PDOStatement;
    public static function getLastInsertId(string $table): int;
}
