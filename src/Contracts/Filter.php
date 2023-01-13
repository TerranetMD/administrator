<?php

namespace Terranet\Administrator\Contracts;

use Terranet\Administrator\Collection\Mutable;

interface Filter
{
    /**
     * Set filters.
     */
    public function setFilters(Mutable $filters = null): mixed;

    /**
     * Set scopes.
     */
    public function setScopes(Mutable $scopes = null): mixed;

    /**
     * Get Filters.
     *
     * @return mixed
     */
    public function filters(): mixed;

    /**
     * Get scopes.
     *
     * @return mixed
     */
    public function scopes(): mixed;
}
