<?php

namespace Terranet\Administrator\Contracts\Module;

interface Editable
{
    /**
     * Define editable fields.
     */
    public function form(): mixed;
}
