<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get language from session or use default
        $locale = Session::get('lang', config('app.locale', 'ar'));
        
        // Set application locale
        App::setLocale($locale);
        
        // Set text direction if available in session
        if (Session::has('text_direction')) {
            config(['app.text_direction' => Session::get('text_direction')]);
        }

        return $next($request);
    }
}
