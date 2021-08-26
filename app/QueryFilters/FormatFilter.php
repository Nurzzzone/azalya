<?php

namespace App\QueryFilters;

use Closure;
use App\Models\Format;

class FormatFilter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (request()->has('format') && !empty(request('format'))) {
            $formats = Format::whereIn('slug', request('format'))->pluck('id');
            $builder->whereHas('formats', fn($query) => 
                $query->whereIn('formats.id', $formats));
        }

        return $builder;
    }
}