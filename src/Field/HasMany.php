<?php

namespace Terranet\Administrator\Field;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Terranet\Administrator\Architect;
use Terranet\Administrator\Exception;
use Terranet\Administrator\Field\Traits\HandlesRelation;
use Terranet\Administrator\Modules\Faked;

class HasMany extends Field
{
    use HandlesRelation;

    const MODE_TAGS = 'tags';
    const MODE_CHECKBOXES = 'checkboxes';

    /** @var string */
    public $icon = 'list-ul';

    public string $titleField = 'name';

    /** @var null|Closure */
    protected $query;

    public string $editMode = self::MODE_CHECKBOXES;

    public bool $completeList = true;

    /**
     * Show editable controls as checkboxes.
     *
     * @return self
     */
    public function tagList(): self
    {
        $this->editMode = static::MODE_TAGS;
        $this->completeList = false;

        return $this;
    }

    /**
     * @param  string  $column
     * @return BelongsToMany
     */
    public function useAsTitle(string $column): self
    {
        $this->titleField = $column;

        return $this;
    }

    /**
     * @param Closure $query
     *
     * @return $this
     */
    public function withQuery(Closure $query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @param string $icon
     *
     * @return self
     */
    public function setIcon(string|null $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @param Builder $query
     * @param Model $model
     * @param string $direction
     *
     * @return Builder
     */
    public function sortBy(Builder $query, Model $model, string $direction): Builder
    {
        return $query->withCount($this->id())->orderBy("{$this->id()}_count", $direction);
    }

    /**
     * @return array
     */
    protected function onIndex(): array
    {
        $relation = $this->relation();
        $related = $relation->getRelated();

        // apply a query
        if ($this->query instanceof Closure) {
            $relation = \call_user_func_array($this->query, [$relation]);
        }

        if ($module = Architect::resourceByEntity($related)) {
            $url = route('scaffold.index', [
                'module' => $module->url(),
                $related->getKeyName() => $related->getKey(),
                'viaResource' => is_a($this, BelongsToMany::class)
                    ? app('scaffold.module')->url()
                    : Str::singular(app('scaffold.module')->url()),
                'viaResourceId' => $this->model->getKey(),
            ]);
        }

        return [
            'module' => $module,
            'count' => $relation->count(),
            'url' => $url ?? null,
        ];
    }

    /**
     * @return array
     * @throws Exception
     *
     */
    protected function onView(): array
    {
        $relation = $this->relation();
        $related = $relation->getRelated();

        // apply a query
        if ($this->query instanceof Closure) {
            $relation = \call_user_func_array($this->query, [$relation]);
        }

        if (!$module = $this->relationModule()) {
            // Build a runtime module
            $module = Faked::make($related);
        }
        $columns = $module->columns()->each->disableSorting();
        $actions = $module->actions();

        $items = $relation;

        if ($items && method_exists($items, 'getResults')) {
            $items = $items->getResults();
        }

        return [
            'module' => $module ?? null,
            'columns' => $columns ?? null,
            'actions' => $actions ?? null,
            'relation' => $relation ?? null,
            'items' => $items,
        ];
    }

    /**
     * @return array
     */
    public function onEdit(): array
    {
        $relation = $this->relation();

        if (static::MODE_CHECKBOXES === $this->editMode && $this->completeList) {
            $values = $this->query
                ? call_user_func_array($this->query, [$relation->getRelated()->query()])
                : $relation->getRelated()->all();
        } else {
            $values = $this->value();
        }

        return [
            'relation' => $relation,
            'searchable' => \get_class($relation->getRelated()),
            'values' => $values,
            'completeList' => $this->completeList,
            'titleField' => $this->titleField,
            'editMode' => $this->editMode,
        ];
    }
}
