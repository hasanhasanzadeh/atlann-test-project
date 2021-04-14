<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()){
            $user= Auth::user();
            if ($user->isManager() && $user->email_verified_at){
                return $next($request);
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect()->route('auth.login');
        }
        //return $next($request);
    }
}
