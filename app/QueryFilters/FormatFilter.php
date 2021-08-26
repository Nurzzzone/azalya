<?php

namespace App\QueryFilters;

use Closure;
use App\Models\Format;

class FormatFilter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (request()->has('format') && request()->filled('format')) {
            $format = Format::where('slug', request('format'))->first();
            $builder->whereHas('formats', fn($query) => 
                $query->where('formats.id', $format->id));
        }

        return $builder;
    }
}