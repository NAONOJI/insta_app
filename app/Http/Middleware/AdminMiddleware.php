<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check() && Auth::user()->role_id === User::ADMIN_ROLE_ID) {
            #Auth::check() --> check if the user is login
            # Auth::user->role_id --> check the role id from the database table
            # User::ADMIN_ROLE_ID --> the Admin role id with 1

            return $next($request);
        }

        return redirect()->route('index');
    }
}
