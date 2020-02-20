<?php

namespace Tenancy\HynNova\Resources;

use Laravel\Nova\Fields;
use Laravel\Nova\Resource;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Tenancy\HynNova\Validators\WebsiteValidator;

class Tenant extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Hyn\Tenancy\Models\Website::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'uuid';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'uuid',
    ];

    /**
     * @return string
     */
    public static function getModel(): string
    {
        return config('tenancy.models.website');
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
        $creationRules = (new WebsiteValidator())->getRulesFor($this->model());
        $updateRules = (new WebsiteValidator())->getRulesFor($this->model(), 'update');

        return [
            Fields\ID::make()->sortable(),

            Fields\Text::make('Uuid')
                ->sortable()
                ->creationRules(Arr::get($creationRules, 'uuid', []))
                ->updateRules(Arr::get($updateRules, 'uuid', []))
                ->help(! config('tenancy.website.disable-random-id') ? 'Will be generated automatically if left blank' : ''),

            Fields\HasMany::make('Hostnames'),
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
