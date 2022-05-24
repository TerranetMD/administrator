<?php

namespace Terranet\Administrator\Field;

class BelongsToMany extends HasMany
{
    /** @var string */
    public $icon = 'random';

    /** @var bool */
    public $inline = false;

    public function useAsTitle(string $column): self
    {
        $this->titleField = $column;

        return $this;
    }

    public function setInline(bool $value): self
    {
        $this->inline = $value;

        return $this;
    }

    public function inline(): bool
    {
        return $this->inline;
    }
}
