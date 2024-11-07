<?php

namespace Terranet\Administrator\Services;

use Terranet\Administrator\Contracts\Module\Navigable;
use Terranet\Administrator\Contracts\Services\TemplateProvider;

class Template implements TemplateProvider
{
    /**
     * Scaffold layout.
     *
     * @param string $layout
     *
     * @return string
     */
    public function layout(string $layout = 'app'): string
    {
        return config('administrator.layouts.'.$layout, 'administrator::layouts.'.$layout);
    }

    /**
     * Scaffold index templates.
     *
     * @param $partial
     *
     * @return mixed array|string
     */
    public function index(string $partial = 'index'): string
    {
        $partials = $this->map(
            'index',
            ['index', 'create', 'export', 'filters', 'scopes', 'header', 'batch', 'row', 'scripts', 'paginator', 'import']
        );

        return null === $partial ? $partials : $partials[$partial];
    }

    /**
     * Scaffold media templates.
     *
     * @param string $partial
     *
     * @return string
     */
    public function media(string $partial = 'index'): string
    {
        $partials = $this->map(
            'media',
            ['index']
        );

        return null === $partial ? $partials : $partials[$partial];
    }

    /**
     * Scaffold translations templates.
     *
     * @param string $partial
     *
     * @return string
     */
    public function translations(string $partial = 'index'): string
    {
        $partials = $this->map(
            'translations',
            ['index']
        );

        return null === $partial ? $partials : $partials[$partial];
    }

    /**
     * Scaffold view templates.
     *
     * @param string $partial
     *
     * @return mixed string
     */
    public function view(string $partial = 'index'): string
    {
        $partials = $this->map('view', [
            'index',
            'model',
            'create',
            'import'
        ]);

        return null === $partial ? $partials : $partials[$partial];
    }

    /**
     * Scaffold edit templates.
     *
     * @param string $partial
     *
     * @return string
     */
    public function edit(string $partial = 'index'): string
    {
        $partials = $this->map('edit', ['index', 'actions', 'row', 'scripts', 'create', 'import']);

        return null === $partial ? $partials : $partials[$partial];
    }

    /**
     * @param  string  $partial
     * @return string
     */
    public function menu(string $partial = 'sidebar'): string
    {
        $partials = $this->map('menus', [Navigable::MENU_SIDEBAR, Navigable::MENU_TOOLS]);

        return null === $partial ? $partials : $partials[$partial];
    }

    /**
     * @param  string  $partial
     * @return string
     */
    public function partials(string $partial = 'messages'): string
    {
        $partials = $this->map('partials', ['messages', 'breadcrumbs']);

        return null === $partial ? $partials : $partials[$partial];
    }

    /**
     * @param  ?string $partial
     * @return string
     */
    public function scripts($partial = null): string
    {
        $partials = $this->map('scripts', ['listeners', 'editors']);

        return null === $partial ? $partials : $partials[$partial];
    }

    /**
     * @param  string $partial
     * @return string
     */
    public function auth(string $partial = 'login'): string
    {
        $partials = $this->map('auth', ['login']);

        return null === $partial ? $partials : $partials[$partial];
    }

    /**
     * @param  ?string $partial
     * @return string
     */
    public function dashboard(string $partial = null): string
    {
        $partials = $this->map('dashboard', ['database', 'members', 'google_analytics']);

        return null === $partial ? $partials : $partials[$partial];
    }

    /**
     * @param $namespace
     * @param array $views
     *
     * @return array
     */
    protected function map($namespace, array $views = []): array
    {
        return array_merge(
            ['index' => "administrator::{$namespace}"],
            array_build($views, function ($key, $view) use ($namespace) {
                return [$view, "administrator::{$namespace}.{$view}"];
            })
        );
    }
}
