<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if($request->is('admin/*'))
        {
            return route('dashboard.admin.index'); // Redirect to admin dashboard if authenticated and accessing admin routes
        }
        return $request->expectsJson() ? null : route('login');
    }
}
