<?php

namespace Terranet\Administrator\Contracts;

use Illuminate\Database\Eloquent\Model;
use Terranet\Administrator\Collection\Mutable;
use Terranet\Administrator\Contracts\Services\Finder;
use Terranet\Administrator\Contracts\Services\Saver;
use Terranet\Administrator\Contracts\Services\TemplateProvider;
use Terranet\Administrator\Requests\UpdateRequest;
use Terranet\Administrator\Services\Breadcrumbs;

interface Module
{
    /**
     * The module Eloquent model.
     *
     * @return mixed
     */
    public function model();

    /**
     * The module title.
     */
    public function title(): string;

    /**
     * The module url.
     */
    public function url(): string;

    /**
     * Define the list of columns to show.
     */
    public function columns(): Mutable;

    /**
     * Define the class responsive for fetching items.
     */
    public function finder(): ?Finder;

    /**
     * Breadcrumbs provider.
     */
    public function breadcrumbs(): ?Breadcrumbs;

    /**
     * Define the class responsive for persisting items.
     */
    public function saver(Model $eloquent, UpdateRequest $request): Saver;

    /**
     * Actions handler.
     */
    public function actions(): ActionsManager;

    /**
     * The module Templates manager.
     */
    public function template(): ?TemplateProvider;

    /**
     * Filters & Scopes handler.
     */
    public function filter(): ?Filter;

    /**
     * Breadcrumb qualified title.
     */
    public function breadcrumbQualifiedTitle(Model $eloquent): ?string;
}
