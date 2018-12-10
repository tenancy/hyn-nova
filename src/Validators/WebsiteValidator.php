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
}
