<?php

namespace Terranet\Administrator\Contracts\Form;

use Illuminate\Database\Query\Builder;

interface Queryable
{
    /**
     * Check if Filter element has a query.
     */
    public function hasQuery(): bool;

    /**
     * Execute filter element's query.
     *
     * @return Builder|mixed
     */
    public function execQuery();
}
