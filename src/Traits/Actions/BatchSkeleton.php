<?php

namespace Terranet\Administrator\Traits\Actions;

use Illuminate\Contracts\Auth\Authenticatable as User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use Terranet\Administrator\Contracts\Module;

trait BatchSkeleton
{
    /**
     * Check if specified user is authorized to execute this action.
     *
     * @param User $viewer
     * @param null|Model $model
     *
     * @return bool
     */
    public function authorize(User $viewer, ?Model $model = null)
    {
        /** @var Module $resource */
        $resource = app('scaffold.module');

        return $resource->actions()->authorize(
            Str::snake(class_basename($this)),
            $model
        );
    }

    public function props(Eloquent $entity = null): ComponentAttributeBag
    {
        $action = app('scaffold.module')->url().'-'.$this->action($entity);
        $attrs = $this->attributes($entity);

        return (new ComponentAttributeBag($attrs))->merge([
            'data-scaffold-action' => $action,
            'data-form-target' => $this->formTarget(),
            'data-scaffold-key' => $this->entityKey($entity),
            'href' => $this->route($entity),
        ]);
    }

    /**
     * @param $model
     *
     * @return string
     */
    protected function route($model)
    {
        return route('scaffold.batch', ['module' => app('scaffold.module')->url()]);
    }

    /**
     * @param $model
     *
     * @return array
     */
    protected function attributes($model): array
    {
        return [
            'data-confirmation' => sprintf('Are you sure you want to %s?', $this->name($model)),
            'data-action' => $this->action($model),
            'class' => 'text-left',
        ];
    }
}
