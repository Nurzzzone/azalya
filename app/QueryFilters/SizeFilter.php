<?php

namespace App\QueryFilters;

use Closure;
use App\Models\Size;
use App\Models\Format;

class SizeFilter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (request()->has('format')) {
            $format = Format::where('slug', request('format'))->first();
            $builder->whereHas('formats', fn($query) => 
                $query->where('formats.id', $format->id));
        }

        return $builder;
    }
}