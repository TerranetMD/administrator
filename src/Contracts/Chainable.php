<?php

namespace Terranet\Administrator\Contracts;

interface Chainable
{
    public function setNext(self $instance);
}
