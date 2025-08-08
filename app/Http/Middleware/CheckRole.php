<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = $request->user();

        if ($user->hasRole('Admin')) {
            return $next($request);
        }

        if (!$user->hasRole($role)) {
            return redirect('/dashboard/index');
        }

        return $next($request);
    }
}
