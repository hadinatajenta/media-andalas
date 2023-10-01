<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard =null): Response
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();

            // Redirect the user based on their role
            switch ($user->role) {
                case 'admin':
                    return redirect('/admin/dashboard');
                case 'author':
                    return redirect('/author/dashboard');
                default:
                    return redirect('/home');
            }
        }

        return $next($request);
    }
}
