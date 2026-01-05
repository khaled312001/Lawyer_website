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
        
        // Get or set text direction automatically based on language
        if (Session::has('text_direction')) {
            $textDirection = Session::get('text_direction');
        } else {
            // Auto-detect direction based on language code
            $rtlLanguageCodes = ["ar", "arc", "dv", "fa", "ha", "he", "khw", "ks", "ku", "ps", "ur", "yi"];
            $textDirection = in_array($locale, $rtlLanguageCodes) ? 'rtl' : 'ltr';
            Session::put('text_direction', $textDirection);
        }
        
        config(['app.text_direction' => $textDirection]);

        return $next($request);
    }
}
