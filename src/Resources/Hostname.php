<?php

namespace Tenancy\HynNova\Resources;

use Laravel\Nova\Fields;
use Laravel\Nova\Resource;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Tenancy\HynNova\Validators\HostnameValidator;

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
    public static $title = 'fqdn';

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
     *
     * @return array
     */
    public function fields(Request $request)
    {
        $creationRules = (new HostnameValidator())->getRulesFor($this->model());
        $updateRules = (new HostnameValidator())->getRulesFor($this->model(), 'update');

        return [
            Fields\ID::make()->sortable(),

            Fields\Text::make('Fqdn')
                ->sortable()
                ->creationRules(Arr::get($creationRules, 'fqdn', []))
                ->updateRules(Arr::get($updateRules, 'fqdn', [])),

            Fields\Text::make('redirect_to')
                ->sortable()
                ->rules(Arr::get($creationRules, 'redirect_to', [])),

            Fields\Boolean::make('Force HTTPS')
                ->rules(Arr::get($creationRules, 'force_https')),

            Fields\DateTime::make('Under Maintenance Since')
                ->rules(Arr::get($creationRules, 'under_maintenance_since', [])),

            Fields\BelongsTo::make('Tenant', 'website'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
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
     *
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
     *
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
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
