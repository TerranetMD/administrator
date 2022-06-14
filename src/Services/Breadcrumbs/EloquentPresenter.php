<?php

namespace Terranet\Administrator\Services\Breadcrumbs;

use Illuminate\Database\Eloquent\Model;

class EloquentPresenter
{
    /**
     * @var Model
     */
    protected $eloquent;

    public function __construct($eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function present()
    {
        if (!($field = $this->getQualifiedTitleName())) {
            $field = $this->eloquent->getRouteKeyName();
        }

        return (string) $this->eloquent->getAttribute($field);
    }

    protected function getQualifiedTitleName()
    {
        $columns = config('administrator.breadcrumbs_qualified_title', ['title', 'name', 'username', 'nickname']);
        $attrs = array_merge(array_flip($this->eloquent->getMutatedAttributes()), $this->eloquent->getAttributes());

        foreach ($columns as $column) {
            if (array_key_exists($column, $attrs)) {
                return $column;
            }
        }

        return null;
    }
}
