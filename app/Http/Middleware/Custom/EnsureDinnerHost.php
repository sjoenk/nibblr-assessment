<?php

namespace App\Http\Middleware\Custom;

use Closure;


class EnsureDinnerHost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $dinner = $request->route()->parameter('dinner');
        $hostUserId = $dinner->host->id;
        if ($hostUserId !== auth()->id()) {
            abort(403, 'The user is not the host');
        }

        return $next($request);
    }
}
