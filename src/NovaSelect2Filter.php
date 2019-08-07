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
        $this->withMeta($this->config());
    }

    public function config() : array
    {
        return [
            'config' => [
                'multiple' => true,
                'allowClear' => true,
                'placeholder' => 'Choose an option',
            ],
        ];
    }
}
