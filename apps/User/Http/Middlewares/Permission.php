<?php

namespace Apps\User\Http\Middlewares;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param                           $permission
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$permissions)
    {

        foreach ($permissions as $permission):
            if (Auth::user()->roles()->whereHas('permissions', function ($query) use ($permission) {

                $query->where('permissions.slug', $permission);
            })->first()) {
                return $next($request);
            }
        endforeach;

        throw new AuthorizationException;
    }
}
