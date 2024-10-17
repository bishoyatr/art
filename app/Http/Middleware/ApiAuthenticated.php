<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\ProductsService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthenticated
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
        if (!$request->header('token'))
        {
             return ProductsService::ErrorResponse("user not authorized");
        }
     $user_login=User::where('remember_token',$request->header('token'))
               ->first();
        if ($user_login) {
            return $next($request);
        }
        if (!$user_login) {
               return ProductsService::ErrorResponse("user not authorized");
        }
    }
}
