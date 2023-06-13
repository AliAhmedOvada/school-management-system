<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->role_id == 3) {
                if (in_array(Route::currentRouteName(), Config::get('constants.stundents'))) {
                    return $next($request);
                }
            } elseif (auth()->user()->role_id == 2) {
                if (in_array(Route::currentRouteName(), Config::get('constants.teachers'))) {
                    return $next($request);
                }
            } elseif (auth()->user()->role_id == 1) {
                if (in_array(Route::currentRouteName(), Config::get('constants.admin'))) {
                    return $next($request);
                }
            }
        }

     dd('you dont have access');
    }
}
