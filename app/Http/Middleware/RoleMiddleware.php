<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Kernel;
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if(!auth()->user()->hasRole($role)) {
        //     abort(404);
        // }
        // if($permission !== null && !auth()->user()->can($permission)) {
        //     abort(404);
        // }
        return $next($request);
    }
}
