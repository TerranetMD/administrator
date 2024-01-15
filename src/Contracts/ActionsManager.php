<?php

namespace Terranet\Administrator\Contracts;

use Illuminate\Database\Eloquent\Model;
use Terranet\Administrator\Actions\Collection;

interface ActionsManager
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(string $method, ?Model $model = null): bool;

    /**
     * Parse given class for single actions.
     */
    public function actions(): array | Collection;

    /**
     * Call handler method.
     */
    public function exec(string $method, array $arguments = []): mixed;
}
