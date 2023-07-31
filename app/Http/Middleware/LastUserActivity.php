<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon as CarbonCarbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LastUserActivity
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
        if (Auth::check()) {
            $user = Auth::user();
            $expiresAt = now()->addMinutes(2);

            if ($user->last_seen) {
                $expiryDate = Carbon::parse($user->last_seen)->addMinutes(2);
            } else {
                $expiryDate = now();
            }

            Cache::put('user-is-online-' . $user->id, true, $expiresAt);
  
            /* user last seen */
            if ($expiryDate < now()) {
                User::where('id', $user->id)->update(['last_seen' => now()]);
            }
        }

        return $next($request);
    }
}
