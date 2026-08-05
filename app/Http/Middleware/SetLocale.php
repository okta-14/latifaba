<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = session('locale', config('app.locale', 'id'));

        $available = ['id', 'en', 'jp'];

        if (in_array($locale, $available)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}