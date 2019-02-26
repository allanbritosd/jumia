<?php
namespace App\Repositories;

use App\Config\ConnectionManager;
use App\Contracts\IRepository;
use App\Contracts\IModel;

abstract class BaseRepository implements IRepository
{
    abstract public function getTableName(): string;
    abstract public function createModel(): IModel;
    abstract public function getWhereStatement(array $filters = []): string;
    abstract public function createModelList(): \SplObjectStorage;

    public function findAll(array $filters = [], int $length = 0, int $offset = 0): \SplObjectStorage
    {
        $modelList = $this->createModelList();
        $sql       = 'SELECT * FROM ' . $this->getTableName();
        $sql      .= ' WHERE ' . $this->getWhereStatement($filters);

        if ($length > 0)
        {
            $sql .= ' LIMIT ' . $length . ' OFFSET '. $offset;
        }

        $records   = ConnectionManager::getInstance()->executeQuery($sql)->fetchAll();

        foreach ($records as $record)
        {
            $model = $this->createModel();
            $model->fill($record);
            $modelList->attach($model);
        }

        return $modelList;
    }

    public function count(array $filters = []): int {
        $modelList = $this->createModelList();
        $sql       = 'SELECT count(*) FROM ' . $this->getTableName();
        $sql      .= ' WHERE ' . $this->getWhereStatement($filters);

        return ConnectionManager::getInstance()->executeQuery($sql)->fetchColumn();
    }

    public function findById(int $id): IModel
    {
        $sql    = 'SELECT * FROM ' . $this->getTableName() . ' where id = ?';
        $record = ConnectionManager::getInstance()->executeQuery($sql, [$id])->fetch();
        $model  = $this->createModel();
        echo "<br/>";
        var_dump($id, $record);
        echo "<br/>";
        $model->fill($record);

        return $model;
    }

    public function delete(IModel $model)
    {
        $sql = 'DELETE FROM ' . $this->getTableName() . ' WHERE id = ?';

        ConnectionManager::getInstance()->executeQuery($sql, [$model->id]);
    }

    public function save(IModel $model): IModel
    {
        if (!empty($model->id))
        {
            $model = $this->update($model);
        } else
        {
            $model = $this->create($model);
        }

        return $model;
    }

    private function update(IModel $model)
    {
        $sql     = 'UPDATE ' . $this->getTableName() . ' SET ';
        $columns = get_object_vars($model);

        $sql .= implode(' = ?, ', array_keys($columns)) . ' = ?';

        $sql .= ' WHERE id = ?';
        $columns[] = $model->id;

        ConnectionManager::getInstance()->executeQuery($sql, $columns);

        return $this->findById($model->id);
    }

    private function create(IModel $model)
    {
        $id = ConnectionManager::getInstance()->getLastInsertId($this->getTableName()) + 1;
        $model->id = $id;

        $sql     = 'INSERT INTO ' . $this->getTableName();
        $columns = get_object_vars($model);

        $sql .= '(' . implode(',', array_keys($columns)) . ')';

        $sql .= ' VALUES(' . substr(str_repeat('?,', count($columns)), 0, -1) . ')';

        $statement = ConnectionManager::getInstance()->executeQuery($sql, $columns);

        return $this->findById($id);
    }

}
