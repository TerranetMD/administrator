<?php

namespace Terranet\Administrator\Field;

class Number extends Field
{
    /** @var string|null */
    public $unit;

    /**
     * Set Element unit.
     *
     * @param string|null $value
     * @return $this
     */
    public function setUnit(?string $value): self
    {
        $this->unit = $value;

        return $this;
    }

    /**
     * Get Element unit.
     *
     * @return string|null
     */
    public function unit(): ?string
    {
        return $this->unit;
    }
}
