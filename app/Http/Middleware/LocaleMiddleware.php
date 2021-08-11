<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LocaleMiddleware
{

    protected $locales;

    public function __construct()
    {
        $this->available_locales = [
            [
                'code'  => 'en', 
                'name'  => 'English'
            ], 
            [
                'code'  => 'ru', 
                'name'  => 'Русский'
            ]
        ];
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        View::share('locales', $this->available_locales);
        if (session()->has('locale')) {
            foreach ($this->available_locales as $available_locale) {
                if (in_array(session()->get('locale'), $available_locale)) {
                    app()->setLocale(session()->get('locale'));
                }
            }
        }
        return $next($request);
    }
}
