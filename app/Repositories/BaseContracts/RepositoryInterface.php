<?php

namespace App\Repositories\BaseContracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function create(array $attributes): Model;

    public function find($id): ?Model;

    public function update(array $attributes): bool;

    public function delete($id): ?bool;
}
