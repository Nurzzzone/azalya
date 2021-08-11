<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    protected $locales;

    public function __construct()
    {
        $this->locales = ['en', 'ru'];
    }

    public function swap($locale)
    {
            if (in_array($locale, $this->locales)) {
                session()->put('locale', $locale);
            }
        
        return redirect()->back();
    }
}
