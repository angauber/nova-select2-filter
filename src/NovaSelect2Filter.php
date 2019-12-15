<?php

namespace Angauber\NovaSelect2Filter;

use Laravel\Nova\Filters\Filter;

abstract class NovaSelect2Filter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'nova-select2-filter';

    public function __construct()
    {
        $this->withMeta(['config' => array_merge($this->config(), $this->defaultConfig())]);
    }

    public function config(): array
    {
        return [
            'multiple' => true,
            'allowClear' => true,
            'placeholder' => 'Choose option(s)',
        ];
    }

    private function defaultConfig(): array
    {
        return [
            'theme' => 'angauber-flat nova-select2-filter-wrapper',
            'containerCssClass' => 'nova-select2-filter-selection',
            'dropdownCssClass' => 'nova-select2-filter-dropdown',
        ];
    }
}
