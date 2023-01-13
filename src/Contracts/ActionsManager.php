<?php

namespace Terranet\Administrator\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ActionsManager
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(string $method, ?Model $model = null): bool;

    /**
     * Parse given class for single actions.
     */
    public function actions(): array;

    /**
     * Call handler method.
     */
    public function exec(string $method, array $arguments = []): mixed;
}
