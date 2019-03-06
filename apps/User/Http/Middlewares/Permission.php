<?php

namespace Apps\User\Http\Middlewares;

use Apps\User\Model\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;

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
//        dd($permissions[0]);



//        $dogs = Auth::user()->with('roles')->first();

//        DB::connection()->enableQueryLog();
//
//        $dogs = Auth::user()->with('roles')->get();
//
//        dd($dogs->toArray());
//
//        $queries = DB::getQueryLog();
////        $last_query = end($queries);
//
//        dd($queries);
//
//        dd(json_encode($dogs));
//
//        dd(Auth::user()->roles()->whereHas('permissions', function ($query) use ($permissions) {
//
////            dd($query->first());
//
//            $query->where('permissions.slug',16);
//        })->first());

        foreach ($permissions as $permission):
            if (Auth::user()->roles()->whereHas('permissions', function ($query) use ($permission) {

                $query->where('permissions.slug',$permission);
            })->first()) {
                return $next($request);
            }
        endforeach;

        throw new UnauthorizedException();
    }
}
