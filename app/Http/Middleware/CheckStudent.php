<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class CheckStudent
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
        if (Auth::check() && UserRole::Student == Auth::user()->role) {
            // Quyen cho student
            return $next($request);
        }
        return redirect()->route('home');
        // redirect()->back()->withErrors('mss', 'Bạn không có quyên truy cập trang đó!');
    }
}
