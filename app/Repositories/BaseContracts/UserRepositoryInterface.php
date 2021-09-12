<?php

namespace App\Repositories\BaseContracts;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;

    public function withPagination();
}
