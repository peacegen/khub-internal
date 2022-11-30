<?php

namespace App\Http\Middleware;

use App\Models\Permission;
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
        $user = $request->user();
        $currentRouteName = Route::currentRouteName();
        $currentRouteAction = Route::currentRouteAction();
        $currentRoute = Route::current();


        echo 'CurrentRouteName: ' . $currentRouteName;
        echo "CurrentRouteAction: " . $currentRouteAction;
        echo "CurrentUserRole" . $request->user()->role;

        if ($currentRouteName == 'pages' && $user->can('edit pages')) {
            return $next($request);
        } else {
            abort(403, __('You are not allowed to access this page.'));
        }
        return $next($request);
    }

    private function userAccessRole()
    {
        // get the user role from the database
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
