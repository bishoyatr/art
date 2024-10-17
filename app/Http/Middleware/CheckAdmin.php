<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
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
       // dd(auth()->user());
       // dd(auth()->user()->isAdmin());
           if (auth()->user() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        return redirect(route('login')); // Redirect to a suitable URL if the user is not an admin.
   
    }
}
