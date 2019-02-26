<?php
namespace App\Contracts;

use App\Contracts\IModel;

interface IRepository
{
    public function getTableName(): string;
    public function createModel(): IModel;
    public function createModelList(): \SplObjectStorage;
    public function findAll(int $length = 0, int $offset = 0): \SplObjectStorage;
    public function findById(int $id): IModel;
    public function delete(IModel $model);
    public function save(IModel $model): IModel;
}
