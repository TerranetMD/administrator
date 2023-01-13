<?php

namespace Terranet\Administrator\Contracts;

interface AutoTranslatable
{
    /**
     * Builds a translation key.
     */
    public function translationKey(): string;
}
