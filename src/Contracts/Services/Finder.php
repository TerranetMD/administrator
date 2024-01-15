<?php

namespace Terranet\Administrator\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface Finder
{
    /**
     * Fetch all items from repository.
     */
    public function fetchAll(): Collection|LengthAwarePaginator;

    /**
     * Find a record by id.
     */
    public function find(string $key, array $columns = ['*']): mixed;
}
