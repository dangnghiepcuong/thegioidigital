<?php

namespace App\Repositories;

abstract class BaseRepository
{
    abstract public function model();

    public function all()
    {
        return $this->model()->all();
    }

    public function paginateAll($relations = [], $perPage = null)
    {
        $perPage = $perPage ?? config('parameter.default_paginate_number');
        return $this->model()->orderBy('created_at', 'desc')
            ->with($relations)
            ->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model()->findOrFail($id);
    }

    public function findWithTrashed($id)
    {
        return $this->model()->withTrashed()->find($id);
    }

    public function findByConditions($conditions = [])
    {
        return $this->model()->where($conditions);
    }

    public function firstOrFail($value)
    {
        return $this->model()->firstOrFail();
    }

    public function firstOrFailByColumnName($column, $value)
    {
        return $this->model()->where($column, $value)
            ->firstOrFail();
    }

    public function firstByConditions($conditions = [])
    {
        return $this->model()->where($conditions)->first();
    }

    public function firstOrFailByConditions($conditions = [])
    {
        return $this->model()->where($conditions)->firstOrFail();
    }

    public function with($relationship)
    {
        return $this->model()->with($relationship);
    }

    public function create($data)
    {
        return $this->model()->create($data);
    }

    public function insert($data)
    {
        return $this->model()->insert($data);
    }

    public function updateOrCreate($condition, $data)
    {
        return $this->model()->updateOrCreate($condition, $data);
    }

    public function update($condition, $data)
    {
        return $this->model()->where($condition)->update($data);
    }

    public function insertOrIgnore($data)
    {
        return $this->model()->insertOrIgnore($data);
    }

    public function whereIn($col, $data)
    {
        return $this->model()->whereIn($col, $data);
    }

    public function whereNotIn($col, $data)
    {
        return $this->model()->whereNotIn($col, $data);
    }

    public function queryByCondition($condition)
    {
        return $this->model()->where($condition);
    }

    public function queryByIds($ids)
    {
        return $this->whereIn('id', $ids);
    }
}
