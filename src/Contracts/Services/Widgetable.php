<?php

namespace Terranet\Administrator\Contracts\Services;

interface Widgetable
{
    /**
     * Widget contents.
     */
    public function render(): mixed;
}
