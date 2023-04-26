<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            $user = Auth::user();
//            dd(Auth::guard());
            if (Auth::guard()->name == 'web'){
//                Auth::guard('web')->logout();
                Auth::guard('admin')->login($user);
//                return redirect(route('admin.login'));
            }
//            dd(Auth::check());
            Auth::guard('admin')->login($user);
            if ($user->hasPermissionTo('admin')) {
                return $next($request);
            } else {
                return redirect(route('admin.login'));
            }
        } else{
            return redirect(route('admin.login'));

        }

    }
}
