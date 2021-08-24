<?php

namespace App\QueryFilters;

use Closure;

class PriceFilter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (request()->has('price_from') && request()->has('price_to')) {
            $price_between = request()->only('price_from', 'price_to');
            $builder->whereBetween("price", $price_between);
        } elseif (request()->has('price_from')) {
            $builder->where('price', '>=', request('price_from'));
        } elseif (request()->has('price_to')) {
            $builder->where('price', '<=', request('price_to'));
        }

        return $builder;
    }
}