<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\SelectedNetwork;

class InitializeSelectedNetwork
{
    /**
     * Ensure default selected network is
     * set on initialization.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        SelectedNetwork::setDefaultIfNotExists();

        return $next($request);
    }
}
