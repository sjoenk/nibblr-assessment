<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next) {
        $user = auth()->user();
        if ($user === null) {
            return response('Unauthenticated user');
        }
        return $next($request);
    }


}
