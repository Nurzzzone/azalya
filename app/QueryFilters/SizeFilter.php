<?php

namespace App\QueryFilters;

use Closure;
use App\Models\Size;

class SizeFilter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (request()->has('size') && !empty(request('size'))) {
            $sizes = Size::whereIn('slug', request('size'))->pluck('id');
            $builder->whereHas('sizes', fn($query) => 
                $query->whereIn('sizes.id', $sizes));
        }

        return $builder;
    }
}