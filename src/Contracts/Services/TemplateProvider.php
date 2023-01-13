<?php

namespace Terranet\Administrator\Contracts\Services;

interface TemplateProvider
{
    /**
     * Scaffold layout.
     */
    public function layout(): string;

    /**
     * Scaffold index template.
     */
    public function index(string $partial = 'index'): array|string;

    /**
     * Scaffold view templates.
     */
    public function view(string $partial = 'index'): array|string;

    /**
     * Scaffold edit templates.
     */
    public function edit(string $partial = 'index'): array|string;

    /**
     * Scaffold navigation templates.
     */
    public function menu(string $partial = 'index'): array|string;

    /**
     * Scaffold partials templates.
     */
    public function partials(string $partial = 'index'): array|string;

    /**
     * Scaffold scripts templates.
     */
    public function scripts(string $partial = 'index'): array|string;

    /**
     * Scaffold auth templates.
     */
    public function auth(string $partial = 'index'): array|string;

    /**
     * Scaffold dashboard templates.
     */
    public function dashboard(string $partial = 'index'): array|string;
}
