<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseContracts\RepositoryInterface;

class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function update(array $attributes, array $updateParam): bool
    {
        return $this->model->update($attributes, $updateParam);
    }

    public function delete($id): ?bool
    {
        return $this->model->delete($id);
    }
}
