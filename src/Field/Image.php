<?php

namespace Terranet\Administrator\Field;

class Image extends File
{
    /**
     * @inheritdoc
     */
    public array $fileTypes = ['image/png', 'image/jpeg'];
}
