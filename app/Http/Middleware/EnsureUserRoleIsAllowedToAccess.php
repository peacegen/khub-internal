<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EnsureUserRoleIsAllowedToAccess
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
        $userRole = auth()->user()->role;
        $currentRouteName = Route::currentRouteName();
        $currentRouteAction = Route::currentRouteAction();
        $currentRoute = Route::current();


        echo 'UserRole: ' . $userRole;
        echo 'CurrentRouteName: ' . $currentRouteName;
        echo "CurrentRouteAction: " . $currentRouteAction;
        if (in_array($currentRouteName, $this->userAccessRole()[$userRole])) {
            return $next($request);
        } else {
            abort(403, __('You are not allowed to access this page.'));
        }
        return $next($request);
    }

    private function userAccessRole()
    {
        // TODO Improve this
        return [
            'user' => [
                'dashboard'
            ],
            'admin' => [
                'pages',
                'dashboard',
                'users',
                'user-permissions',
            ]
            ];
    }
}
