<?php

namespace Terranet\Administrator\Contracts\Module;

use Illuminate\Http\Request;

interface Navigable
{
    const MENU_SIDEBAR = 'sidebar';
    const MENU_TOOLS = 'tools';
    const AS_LINK = 'link';
    const AS_HEADER = 'header';

    /**
     * Navigation container which Resource belongs to
     * Available: sidebar, tools.
     */
    public function navigableIn(): mixed;

    /**
     * Append default params to navigation link.
     * Useful for default filters, scopes, etc...
     */
    public function navigableParams(): array;

    /**
     * Add resource to navigation if condition accepts.
     */
    public function showIf(Request $request): bool;

    /**
     * Add resource to navigation as link or header.
     */
    public function showAs(): mixed;

    /**
     * Navigation group which Resource belongs to.
     */
    public function group(): string;

    /**
     * Resource order number.
     */
    public function order(): int;

    /**
     * Attributes assigned to <a> element.
     */
    public function linkAttributes(): mixed;
}
