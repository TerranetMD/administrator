<?php

namespace Terranet\Administrator\Contracts\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface Searchable
{
    public function searchBy(Builder $query, Model $model): Builder;
}
