<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CheckUserStatus
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
        if(Auth::check() && Auth::user()->enabled == 0 || Auth::check() && Auth::user()->enabled == false){            
            Auth::guard('web')->logout();
            // Auth::logout();
            $request->session()->invalidate();
            // $request->session()->regenerateToken();
            
            $message = 'Your Account is not Enabled. Please contact the Administrator.';
            $request->session()->flash('error', $message);

            if(checkAjaxJsonRequest($request)) {
                return response(['message' => $message], 403);
            }
            return redirect()->route('login');
            // return redirect()->route('login')->withErrors([$message]);
        }

        return $next($request);
    }
}
