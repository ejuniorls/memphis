<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Supported locales for the application.
     */
    protected array $supportedLocales = ['en', 'pt_BR'];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Query param: ?lang=pt_BR  (handy for testing)
        if ($request->has('lang')) {
            $locale = $request->query('lang');
            if (in_array($locale, $this->supportedLocales, true)) {
                session(['locale' => $locale]);
            }
        }

        // 2. Authenticated user preference (if the User model gains a `locale` column)
        // if (auth()->check() && auth()->user()->locale) {
        //     $locale = auth()->user()->locale;
        // }

        // 3. Session-stored locale
        $locale = session('locale', config('app.locale'));

        // 4. Ensure only supported locales are applied
        if (!in_array($locale, $this->supportedLocales, true)) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
