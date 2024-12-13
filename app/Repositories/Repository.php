<?php

namespace App\Repositories;

abstract class Repository
{
    protected $model, $table;

    public function __construct($model)
    {
        $this->model = $model;
        $this->table = $this->model->getTable();
    }

    public function fetchAll($params = [])
    {
        $query = $this->query($params);

        if (!$params['paginated']) {
            return $query->get();
        }

        return $query->paginate(
            $params['perPage'],
            $params['columns'],
            'page',
            $params['page'],
        )
        ->withQueryString();
    }

    private function query(array $params)
    {
        extract($params);

        return $this->model->select($columns ?? ['*'])
            ->when(
                isset($where) && !$this->isEmptyArray($where),
                function ($query) use ($where) {
                    foreach ($where as $columnName => $value) {
                        if (is_string($columnName)) {
                            $query->where($columnName, $value);
                        }
                    }
                }
            )
            ->when(
                isset($orderBy) && is_string($orderBy) && isset($sortBy) && (is_string($sortBy) || is_array($sortBy)),
                function ($query) use ($sortBy, $orderBy) {
                    if (is_string($sortBy) && !str_contains($sortBy, ',')) {
                        $query->orderBy($sortBy, $orderBy);
                    } elseif (is_string($sortBy) && str_contains($sortBy, ',')) {
                        $sortBy = explode(',', $sortBy);
                    }

                    if (is_array($sortBy)) {
                        foreach ($sortBy as $column) {
                            $query->orderBy(trim($column), $orderBy);
                        }
                    }
                }
            )
            ->when(
                isset($offset, $limit) && (!isset($paginate) || !$paginate),
                function ($query) use ($offset, $limit) {
                    $query->skip($offset)->take($limit);
                }
            )
            ->when(
                isset($relations) && is_array($relations) && !$this->isEmptyArray($relations),
                function ($query) use ($relations) {
                    $query->with($relations);
                }
            );
    }


    public function first($params = [])
    {
        return $this->query($params)->first();
    }

    public function firstOrFail($params = [])
    {
        return $this->query($params)->firstOrFail();
    }

    public function findOrFail(int $id, $params = [])
    {
        if ($this->isEmptyArray($params)) {
            return $this->model->findOrFail($id);
        }

        return $this->query($params)->findOrFail($id);
    }

    public function find(int $id, $params = [])
    {
        if ($this->isEmptyArray($params)) {
            return $this->model->find($id);
        }

        return $this->query($params)
            ->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data)
    {
        return $this->model->find($data['id'])
            ->update($data);
    }

    public function updateOrCreate(array $data)
    {
        return $this->model->updateOrCreate($data);
    }

    public function firstOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    public function delete(int $id)
    {
        return $this->model->findOrFail($id)
            ->delete();
    }

    public function forceDelete(int $id)
    {
        return $this->model->findOrFail($id)
            ->forceDelete();
    }

    public function restore(int $id)
    {
        return $this->model->findOrFail($id)
            ->restore();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getTableName()
    {
        return $this->model->getTable();
    }

    private function isEmptyArray(array $arr)
    {
        return count($arr) === 0;
    }
}
