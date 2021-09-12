<?php

namespace App\Repositories\BaseContracts;

use Illuminate\Support\Collection;

interface ContactRepositoryInterface
{
    public function all(): Collection;

    public function phones(): Collection;

    public function emails(): Collection;
}
