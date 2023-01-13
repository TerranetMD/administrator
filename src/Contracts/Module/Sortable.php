<?php

namespace Terranet\Administrator\Contracts\Module;

interface Sortable
{
    /**
     * Define list of sortable columns.
     */
    public function sortable(): array;
}
