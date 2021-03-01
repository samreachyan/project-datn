<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        if (Auth::check() && UserRole::Admin == Auth::user()->role) {
            return $next($request);
        }
        return redirect()->route('home');
        // return redirect()->back()->withErrors('mss', 'Bạn không có quyên truy cập trang đó!');
    }
}
