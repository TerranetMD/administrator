<?php

namespace Terranet\Administrator\Contracts\Form;

interface Relationship
{
    /**
     * Set Element relation string.
     *
     * @param $relation
     */
    public function setRelation($relation): mixed;
}
