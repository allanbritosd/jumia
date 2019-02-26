<?php
namespace App\Contracts;

interface IPdoDatabaseConnector
{
    public function executeQuery(string $sql): \PDOStatement;
    public function getLastInsertId(string $table): int;
}
