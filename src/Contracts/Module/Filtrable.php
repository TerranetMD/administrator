<?php

namespace Terranet\Administrator\Contracts\Module;

use Terranet\Administrator\Collection\Mutable;

interface Filtrable
{
    /**
     * Declare scaffold filters.
     */
    public function filters(): Mutable;

    /**
     * Declare scaffold scopes.
     */
    public function scopes(): Mutable;
}
