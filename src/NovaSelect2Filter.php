<?php

namespace Angauber\NovaSelect2Filter;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class NovaSelect2Filter extends Filter
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

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query;
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [];
    }
}
