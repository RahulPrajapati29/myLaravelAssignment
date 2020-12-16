<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isUserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if($user->isAdmin)
        {
            return $next($request);
        }
        else
        {
            abort(404);
        }
    }
}
