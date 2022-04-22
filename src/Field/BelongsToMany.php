<?php

namespace Terranet\Administrator\Field;

class BelongsToMany extends HasMany
{
    /** @var string */
    public $icon = 'random';

    /**
     * @param string $column
     * @return BelongsToMany
     */
    public function useAsTitle(string $column): self
    {
        $this->titleField = $column;

        return $this;
    }
}
