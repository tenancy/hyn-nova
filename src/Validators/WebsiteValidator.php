<?php

namespace Tenancy\HynNova\Validators;

use Hyn\Tenancy\Abstracts\Validator;

class WebsiteValidator extends Validator
{
    protected $create = [
        'uuid' => ['required', 'string', "unique:%system%.%websites%,uuid"],
    ];
    protected $update = [
        'uuid' => ['required', 'string', "unique:%system%.%websites%,uuid,{{resourceId}}"],
    ];

    /**
     * @param $model
     * @param string $for
     * @return array
     */
    public function getRulesFor($model, $for = 'create'): array
    {
        $rules = $this->{$for} ?? [];

        if (!config('tenancy.website.disable-random-id')) {
            $key = array_search('required', $rules['uuid']);
            $rules['uuid'][$key] = 'nullable';
        }

        return $this->replaceVariables($rules, $model);
    }
}
