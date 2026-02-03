<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $permissions = $request->session()->get('permission');
        $segment = $request->segment(config('constants.url_segment'));
        if (Arr::exists($permissions, $segment) || $segment == 'admindashboard') {
            if ($segment == 'admindashboard') {
                return $next($request);
            } else {
                if ($permissions[$segment]['visible']) {
                    return $next($request);
                }
            }
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
