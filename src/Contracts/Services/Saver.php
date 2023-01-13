<?php

namespace Terranet\Administrator\Contracts\Services;

interface Saver
{
    /**
     * Process request and persist data.
     */
    public function sync(): mixed;
}
