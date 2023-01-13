<?php

namespace Terranet\Administrator\Contracts\Services;

interface CrudActions
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param string $method
     * @param $eloquent
     *
     * @return bool
     */
    public function authorize(string $method, $eloquent = null): bool;

    /**
     * List of single actions.
     */
    public function actions(): array;

    /**
     * List of batch actions.
     */
    public function batchActions(): mixed;

    /**
     * List of toolbar actions.
     */
    public function toolbarActions(): mixed;
}
