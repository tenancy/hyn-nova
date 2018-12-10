<?php

namespace Tenancy\HynNova\Validators;

use Hyn\Tenancy\Abstracts\Validator;

class HostnameValidator extends Validator
{
    protected $create = [
        'fqdn' => ['required', 'string', 'unique:%system%.%hostnames%,fqdn'],
        'redirect_to' => ['nullable', 'string', 'url'],
        'force_https' => ['boolean'],
        'under_maintenance_since' => ['nullable', 'date'],
        'website_id' => ['nullable', 'integer', 'exists:%system%.%websites%,id'],
    ];

    protected $update = [
        'id' => ['required', 'integer'],
        'fqdn' => ['required', 'string', 'unique:%system%.%hostnames%,fqdn,{{resourceId}}'],
        'redirect_to' => ['nullable', 'string', 'url'],
        'force_https' => ['boolean'],
        'under_maintenance_since' => ['nullable', 'date'],
        'website_id' => ['nullable', 'integer', 'exists:%system%.%websites%,id'],
    ];
}
