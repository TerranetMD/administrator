<?php

namespace Terranet\Administrator\Contracts\Module;

interface Validable
{
    /**
     * Validation rules.
     */
    public function rules(): array;
}
