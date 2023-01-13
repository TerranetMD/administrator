<?php

namespace Terranet\Administrator\Contracts\Module;

interface Exportable
{
    /**
     * Available export formats.
     */
    public function formats(): array;

    /**
     * Get exportable url.
     *
     * @param $format
     */
    public function makeExportableUrl($format): string;
}
