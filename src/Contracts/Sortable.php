<?php

namespace Terranet\Administrator\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface Sortable
{
    public function sortBy(Builder $query, Model $model, string $direction): Builder;
}
