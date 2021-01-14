<?php

namespace App\Http\Middleware\Custom;

use App\Helpers\UserManagement;
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

    use UserManagement;

    public function handle($request, Closure $next)
    {
        $dinner = $request->route()->parameter('dinner');
        $hostUserId = $dinner->host->id;
        if ($hostUserId !== $this->getUserId()) {
            return response('The user is not the host');
        }

        return $next($request);
    }
}
