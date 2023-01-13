<?php

namespace Terranet\Administrator\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;

interface Finder
{
    /**
     * Fetch all items from repository.
     */
    public function fetchAll(): Collection;

    /**
     * Find a record by id.
     */
    public function find(string $key, array $columns = ['*']): mixed;
}
