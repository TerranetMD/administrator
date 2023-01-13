<?php

namespace Terranet\Administrator\Annotations;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
final class ScopeFilter
{
    public string $name;
    public string $translate;
    public string $icon;
}
