<?php

namespace Terranet\Administrator\Contracts\Form;

interface Validable
{
    /**
     * Set validation rules.
     */
    public function setRules(array $rules = []): mixed;
}
