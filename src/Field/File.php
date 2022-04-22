<?php

namespace Terranet\Administrator\Field;

use Terranet\Administrator\Scaffolding;

class File extends Field
{
    /**
     * Accepted file types
     *
     * @var string[]
     */
    public array $fileTypes = [];

    public bool $multiple = false;

    /**
     * Max file size in kilobytes
     */
    public int $maxFileSize = 1024;

    public $visibility = [
        Scaffolding::PAGE_INDEX => true,
        Scaffolding::PAGE_EDIT => true,
        Scaffolding::PAGE_VIEW => true,
    ];

    public function onEdit(): array
    {
        return $this->onIndex();
    }

    public function onView(): array
    {
        return $this->onIndex();
    }

    protected function onIndex(): array
    {
        return [
            'attachment' => $this->model ? $this->model->{$this->id} : null,
        ];
    }

    /**
     * @param string[] $fileTypes
     */
    public function setFileTypes(array $fileTypes): self
    {
        $this->fileTypes = $fileTypes;

        return $this;
    }

    /**
     * @return string[]
     */
    public function fileTypes(): array
    {
        return $this->fileTypes;
    }

    public function setMultiple(bool $multiple): self
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function multiple(): bool
    {
        return $this->multiple;
    }

    /**
     * @param int $fileSize Max file size in kilobytes
     */
    public function setMaxFileSize(int $fileSize): self
    {
        $this->maxFileSize = $fileSize;

        return $this;
    }

    /**
     * @return int Max file size in kilobytes
     */
    public function maxFileSize(): int
    {
        return $this->maxFileSize;
    }
}
