<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LevelMiddleware
{
    public function handle(Request $request, Closure $next, ...$level)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }

        if(!in_array(Auth::user()->level,$level))
        {
            abort(403);
        }

        return $next($request);
    }
}