<?php

namespace Tenancy\HynNova\Http\Controllers;

use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;

class TenantController
{
    /**
     * @var WebsiteRepository
     */
    private $tenants;

    public function __construct(WebsiteRepository $tenants)
    {
        $this->tenants = $tenants;
    }

    public function __invoke()
    {
        return $this->tenants->query()->paginate();
    }
}