<?php
namespace App\Contracts;

use App\Contracts\IModel;

interface IRepository
{
    public function getTableName(): string;
    public function createModel(): IModel;
    public function createModelList(): \SplObjectStorage;
    public function findAll(array $filters = [], int $length = 0, int $offset = 0): \SplObjectStorage;
    public function count(array $filters = []): int;
    public function findById(int $id): IModel;
    public function delete(IModel $model);
    public function save(IModel $model): IModel;
}
