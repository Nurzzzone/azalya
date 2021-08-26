<?php

namespace App\QueryFilters;

use Closure;
use App\Models\Size;

class SizeFilter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (request()->has('format') && request()->filled('size')) {
            $format = Size::where('slug', request('size'))->first();
            $builder->whereHas('sizes', fn($query) => 
                $query->where('sizes.id', $format->id));
        }

        return $builder;
    }
}