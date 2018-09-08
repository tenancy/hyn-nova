<?php

namespace Tenancy\HynNova\Http\Middleware;

use Tenancy\HynNova\HynNova;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(HynNova::class)->authorize($request) ? $next($request) : abort(403);
    }
}
