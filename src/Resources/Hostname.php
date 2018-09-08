<?php

namespace Tenancy\HynNova\Resources;

use Hyn\Tenancy\Validators\HostnameValidator;
use Laravel\Nova\Fields;
use Illuminate\Http\Request;
use Laravel\Nova\Resource;

class Hostname extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Hyn\Tenancy\Models\Hostname::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'fqdn',
    ];

    /**
     * @return string
     */
    public static function getModel(): string
    {
        return config('tenancy.models.hostname');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $rules = (new HostnameValidator())->getRulesFor($this->model());

        return [
            Fields\ID::make()->sortable(),

            Fields\Text::make('Fqdn')
                ->sortable()
                ->rules(array_get($rules, 'fqdn', [])),

            Fields\Text::make('redirect_to')
                ->sortable()
                ->rules(array_get($rules, 'redirect_to', [])),

            Fields\Boolean::make('Force HTTPS')
                ->rules(array_get($rules, 'force_https')),

            Fields\DateTime::make('Under Maintenance Since')
                ->rules(array_get($rules, 'under_maintenance_since', [])),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
